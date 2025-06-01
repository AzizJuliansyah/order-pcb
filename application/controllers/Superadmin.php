<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Superadmin extends CI_Controller {
    
	public function __construct()
    {
        parent::__construct();
        is_logged_in();
        check_access(['1']);

        $this->load->model('User_model');
        $this->load->model('Settings_model');
        $this->load->library('form_validation');
    }

    public function dashboard()
	{
		$user_id = $this->session->userdata('user_id');
        $data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();

        $data['title'] = 'Superadmin Dashboard';

        $data['errors'] = $this->session->flashdata('errors') ?? [];
        $data['old'] = $this->session->flashdata('old') ?? [];

        $roles = $this->db->get('role')->result_array();

        $query = $this->db->query("
            SELECT 
                role.role_id, 
                COUNT(user.id) AS total_user,
                SUM(CASE WHEN user.is_active = 1 THEN 1 ELSE 0 END) AS total_aktif,
                SUM(CASE WHEN user.is_active = 0 THEN 1 ELSE 0 END) AS total_nonaktif,
                MAX(user.date_created) AS last_created,
                TIMESTAMPDIFF(HOUR, MAX(user.date_created), NOW()) AS hours_since_last_created
            FROM role
            LEFT JOIN user ON user.role_id = role.role_id
            GROUP BY role.role_id
        ");

        $role_info = [];
        foreach ($query->result_array() as $r) {
            $role_info[$r['role_id']] = $r;
        }

        foreach ($roles as &$role) {
            $rid = $role['role_id'];
            $role['total_user'] = $role_info[$rid]['total_user'] ?? 0;
            $role['total_aktif'] = $role_info[$rid]['total_aktif'] ?? 0;
            $role['total_nonaktif'] = $role_info[$rid]['total_nonaktif'] ?? 0;
            $role['last_created'] = $role_info[$rid]['last_created'] ?? null;
            $role['hours_since_last_created'] = $role_info[$rid]['hours_since_last_created'] ?? null;
        }

        $data['role_list'] = $roles;

        $recent_users_per_role = [];

        foreach ($roles as $r) {
            $role_id = $r['role_id'];
            $recent_users = $this->db
                ->select('foto')
                ->from('user')
                ->where('role_id', $role_id)
                ->where('foto IS NOT NULL', null, false) // biar tidak di-escape
                ->where('foto !=', '')
                ->order_by('date_created', 'DESC')
                ->limit(4)
                ->get()
                ->result_array();

            $recent_users_per_role[$role_id] = $recent_users;
        }

        $data['recent_users_per_role'] = $recent_users_per_role;

        $global_query = $this->db->query("
            SELECT 
                COUNT(id) AS total_user,
                SUM(CASE WHEN is_active = 1 THEN 1 ELSE 0 END) AS total_aktif,
                SUM(CASE WHEN is_active = 0 THEN 1 ELSE 0 END) AS total_nonaktif,
                MAX(date_created) AS last_created,
                TIMESTAMPDIFF(HOUR, MAX(date_created), NOW()) AS hours_since_last_created
            FROM user
        ");

        $data['global_user_stats'] = $global_query->row_array();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('superadmin/dashboard', $data);
        $this->load->view('layout/alert');
        $this->load->view('layout/footer');
	}



    public function edit_settings()
    {
        $redirect = $this->input->server('HTTP_REFERER') ?? base_url('default-url');


        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('settings_id', 'settings_id', 'required|trim', [
                'required' => '%s wajib diisi.'
            ]);

            $encrypted_settings_id = $this->input->post('settings_id');
            $settings_id = decrypt_id($encrypted_settings_id);

            if (empty($settings_id)) {
                $this->session->set_flashdata('error', 'Gagal mengakses halaman, Settings ID tidak ada.');
                redirect($redirect);
            }

            $settings = $this->db->get_where('settings', ['settings_id' => $settings_id])->row_array();
            if (!$settings) {
                $this->session->set_flashdata('error', 'Data Settings tidak ditemukan.');
                redirect($redirect);
            }


            if (isset($_FILES['item']) && $_FILES['item']['name']) {
                $config['upload_path']   = './public/web_assets/images/settings_images/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
                $config['max_size']      = 2048; // 2MB
                $config['file_name'] = 'settings_' . $user_id . '_' . time(); // biar unik

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('item')) {
                    $this->session->set_flashdata('errors', [
                        'item' => $this->upload->display_errors('', ''),
                    ]);
                    $this->session->set_flashdata('old', [
                        'settings_id' => set_value('settings_id'),
                    ]);

                    
                    redirect($redirect);
                } else {
                    
                    $uploadData = $this->upload->data();
                    $item = 'web_assets/images/settings_images/' . $uploadData['file_name'];
                    
                    $settings = $this->db->get_where('settings', ['id' => $settings_id])->row_array();

                    if (!empty($settings['item']) && file_exists('./public/' . $settings['item'])) {
                        unlink('./public/' . $settings['item']);
                    }
                }
            } else {
                $this->form_validation->set_rules('item', 'item', 'required|trim', [
                    'required' => '%s wajib diisi.'
                ]);

                if ($this->form_validation->run() === FALSE) {
                    $this->session->set_flashdata('old', [
                        'settings_id' => set_value('settings_id'),
                        'item'        => set_value('item'),
                    ]);
                    $this->session->set_flashdata('errors', [
                        'item'        => form_error('item'),
                        'settings_id' => form_error('settings_id'),
                    ]);
                    
                    redirect($redirect);
                } else {
                    $item = $this->input->post('item', TRUE);
                }
            }

            $this->Settings_model->update_settings($settings_id, ['item' => $item]);

            $this->session->set_flashdata('success', 'Item berhasil diubah.');
            redirect($redirect);
        } else {
            $this->session->set_flashdata('error', 'Item gagal diubah.');
            
            redirect($redirect);
        }
    }

    public function auth_google()
	{
		$user_id = $this->session->userdata('user_id');
		$data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();

		$data['title'] = 'Auth Google Settings';

        $data['settings'] = $this->db->where_in('settings_id', [1, 2])->get('settings')->result_array();

		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
        $this->load->view('layout/sidebar', $data);
		$this->load->view('superadmin/settings/auth_google', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
	}

    public function ui_ux()
	{
		$user_id = $this->session->userdata('user_id');
		$data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();

		$data['title'] = 'UI UX Settings';

        $data['settings'] = $this->db->where_in('settings_id', [3, 4])->get('settings')->result_array();
        $data['carousel_images'] = $this->db->get('carousel_images')->result_array();

        $data['errors'] = $this->session->flashdata('errors') ?? [];
        $data['old'] = $this->session->flashdata('old') ?? [];

		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
        $this->load->view('layout/sidebar', $data);
		$this->load->view('superadmin/settings/ui_ux', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
	}

    
    public function midtrans_credential()
	{
		$user_id = $this->session->userdata('user_id');
		$data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();

		$data['title'] = 'Midtrans Credential Settings';

        $data['settings'] = $this->db->where_in('settings_id', [5, 6])->get('settings')->result_array();

		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
        $this->load->view('layout/sidebar', $data);
		$this->load->view('superadmin/settings/midtrans_credential', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
	}

    public function tambah_carousel_images()
    {
        $redirect = $this->input->server('HTTP_REFERER') ?? base_url('default-url');

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('heading', 'Heading', 'required|trim', [
                'required' => '%s wajib diisi.'
            ]);
            $this->form_validation->set_rules('sub_heading', 'Sub Heading', 'required|trim', [
                'required' => '%s wajib diisi.'
            ]);

            if ($this->form_validation->run() === FALSE) {
                $this->session->set_flashdata('old', [
                    'heading'     => set_value('heading'),
                    'sub_heading'  => set_value('sub_heading'),
                ]);
                $this->session->set_flashdata('errors', [
                    'heading'     => form_error('heading'),
                    'sub_heading'  => form_error('sub_heading'),
                ]);
                redirect($redirect);
            }

            $heading = $this->input->post('heading', TRUE);
            $sub_heading = $this->input->post('sub_heading', TRUE);

            $config['upload_path'] = './public/web_assets/images/carousel_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['max_size'] = 5120; // Max 2MB
            // $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect($redirect);
            } else {
                $uploadData = $this->upload->data();
                $image_name = $uploadData['file_name'];

                $data = [
                    'heading'     => $heading,
                    'sub_heading'  => $sub_heading,
                    'images'       => 'web_assets/images/carousel_images/' . $image_name,
                ];
                $this->db->insert('carousel_images', $data);

                $this->session->set_flashdata('success', 'Carousel berhasil ditambah.');
                redirect($redirect);
            }
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan carousel.');
            redirect($redirect);
        }
    }

    public function edit_carousel_images()
    {
        $redirect = $this->input->server('HTTP_REFERER') ?? base_url('default-url');

        $encrypted_carousel_images_id = $this->input->post('carousel_images_id');
        $carousel_images_id = decrypt_id($encrypted_carousel_images_id);
        $carousel = $this->db->get_where('carousel_images', ['id' => $carousel_images_id])->row_array();
        if (!$carousel) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan.');
            redirect($redirect);
        }

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('heading', 'Heading', 'required|trim');
            $this->form_validation->set_rules('sub_heading', 'Sub Heading', 'required|trim');

            if ($this->form_validation->run() === FALSE) {
                $this->session->set_flashdata('errors', [
                    'heading'     => form_error('heading'),
                    'sub_heading' => form_error('sub_heading'),
                ]);
                redirect($redirect);
            }

            $heading = $this->input->post('heading', TRUE);
            $sub_heading = $this->input->post('sub_heading', TRUE);

            $data = [
                'heading'     => $heading,
                'sub_heading' => $sub_heading,
            ];

            if (!empty($_FILES['image']['name'])) {
                $config['upload_path']   = './public/web_assets/images/carousel_images/';
                $config['allowed_types'] = 'jpg|jpeg|png|webp';
                $config['max_size']      = 5120; // 5MB
                // $config['encrypt_name']  = TRUE;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    if (!empty($carousel['images']) && file_exists(FCPATH . 'public/' . $carousel['images'])) {
                        unlink(FCPATH . 'public/' . $carousel['images']);
                    }

                    $uploadData = $this->upload->data();
                    $data['images'] = 'web_assets/images/carousel_images/' . $uploadData['file_name'];
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect($redirect);
                }
            }

            $this->db->update('carousel_images', $data, ['id' => $carousel_images_id]);

            $this->session->set_flashdata('success', 'Carousel berhasil diperbarui.');
            redirect($redirect);
        }

        $this->session->set_flashdata('error', 'Metode tidak valid.');
        redirect($redirect);
    }

    public function delete_carousel_images()
    {
        
        $redirect = $this->input->server('HTTP_REFERER') ?? base_url('default-url');

        $encrypted_carousel_images_id = $this->input->post('carousel_images_id');
        $carousel_images_id = decrypt_id($encrypted_carousel_images_id);
        $carousel = $this->db->get_where('carousel_images', ['id' => $carousel_images_id])->row_array();
        if (!$carousel) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan.');
            redirect($redirect);
        }

        // Hapus file gambar jika ada
        if (!empty($carousel['images']) && file_exists(FCPATH . 'public/' . $carousel['images'])) {
            unlink(FCPATH . 'public/' . $carousel['images']);
        }

        $this->db->delete('carousel_images', ['id' => $carousel_images_id]);

        $this->session->set_flashdata('success', 'Carousel berhasil dihapus.');
        redirect($redirect);
    }







    public function user_list()
    {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();

        $data['title'] = 'User List';

        $data['errors'] = $this->session->flashdata('errors') ?? [];
        $data['old'] = $this->session->flashdata('old') ?? [];

        $roles = $this->db->get('role')->result_array();

        $query = $this->db->query("
            SELECT 
                role.role_id, 
                COUNT(user.id) AS total_user,
                SUM(CASE WHEN user.is_active = 1 THEN 1 ELSE 0 END) AS total_aktif,
                SUM(CASE WHEN user.is_active = 0 THEN 1 ELSE 0 END) AS total_nonaktif,
                MAX(user.date_created) AS last_created,
                TIMESTAMPDIFF(HOUR, MAX(user.date_created), NOW()) AS hours_since_last_created
            FROM role
            LEFT JOIN user ON user.role_id = role.role_id
            GROUP BY role.role_id
        ");

        $role_info = [];
        foreach ($query->result_array() as $r) {
            $role_info[$r['role_id']] = $r;
        }

        foreach ($roles as &$role) {
            $rid = $role['role_id'];
            $role['total_user'] = $role_info[$rid]['total_user'] ?? 0;
            $role['total_aktif'] = $role_info[$rid]['total_aktif'] ?? 0;
            $role['total_nonaktif'] = $role_info[$rid]['total_nonaktif'] ?? 0;
            $role['last_created'] = $role_info[$rid]['last_created'] ?? null;
            $role['hours_since_last_created'] = $role_info[$rid]['hours_since_last_created'] ?? null;
        }

        $data['role_list'] = $roles;

        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('superadmin/user/user_list', $data);
        $this->load->view('layout/alert');
        $this->load->view('layout/footer');
    }

    public function user_list_role($jabatan_url = null)
    {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();
        
        $data['title'] = 'User List Per Role';

        $data['errors'] = $this->session->flashdata('errors') ?? [];
        $data['old'] = $this->session->flashdata('old') ?? [];

        $jabatan_clean = str_replace('-', ' ', urldecode($jabatan_url));
        $role = $this->db->get_where('role', ['LOWER(jabatan)' => strtolower($jabatan_clean)])->row_array();

        if (!$role) {
            $this->session->set_flashdata('error', 'Maaf, role tidak ditemukan');
            redirect('superadmin/user_list');
        }

        $role_id = $role['role_id'];

        $this->db->order_by('date_created', 'DESC');
        $data['users_by_role'] = $this->db->get_where('user', ['role_id' => $role_id])->result_array();
        $data['selected_role'] = $role;

        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('superadmin/user/user_list_role', $data);
        $this->load->view('layout/alert');
        $this->load->view('layout/footer');
    }

    public function change_status()
    {
        $redirect = $this->input->server('HTTP_REFERER') ?? base_url('superadmin/user_list');
        
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('user_id', 'user_id', 'required|trim', [
                'required' => '%s wajib diisi.'
            ]);

            if ($this->form_validation->run() === FALSE) {
                $this->session->set_flashdata('old', [
                    'user_id'  => set_value('user_id'),
                    
                ]);
                $this->session->set_flashdata('errors', [
                    'user_id'            => form_error('user_id'),
                    
                ]);
                redirect($redirect);
            } else {
                $encrypted_user_id = $this->input->post('user_id');
                $user_id = decrypt_id($encrypted_user_id);

                if (empty($user_id)) {
                    $this->session->set_flashdata('error', 'Gagal mengakses halaman, user ID tidak ada.');
                    redirect($redirect);
                }

                $user = $this->db->get_where('user', ['id' => $user_id])->row_array();
                if (!$user) {
                    $this->session->set_flashdata('error', 'Data user tidak ditemukan.');
                    redirect($redirect);
                }
                $status = $this->input->post('status');
                

                $this->User_model->update_user($user_id, ['is_active' => $status]);
                $this->session->set_flashdata('success', 'Status user berhasil di ubah.');

                redirect($redirect);
            }
        } else {
            $this->session->set_flashdata('error', 'Status user gagal di ubah.');
            redirect($redirect);
        }
    }

    public function change_password()
    {

        $redirect = $this->input->server('HTTP_REFERER') ?? base_url('superadmin/user_list');
        
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('user_id', 'user_id', 'required|trim', [
                'required' => '%s wajib diisi.'
            ]);

            if ($this->form_validation->run() === FALSE) {
                $this->session->set_flashdata('old', [
                    'user_id'  => set_value('user_id'),
                    
                ]);
                $this->session->set_flashdata('errors', [
                    'user_id'            => form_error('user_id'),
                    
                ]);
                redirect($redirect);
            } else {
                $encrypted_user_id = $this->input->post('user_id');
                $user_id = decrypt_id($encrypted_user_id);

                if (empty($user_id)) {
                    $this->session->set_flashdata('error', 'Gagal mengakses halaman, user ID tidak ada.');
                    redirect($redirect);
                }

                $user = $this->db->get_where('user', ['id' => $user_id])->row_array();
                if (!$user) {
                    $this->session->set_flashdata('error', 'Data user tidak ditemukan.');
                    redirect($redirect);
                }

                $new_password = password_hash($this->input->post('npassword'), PASSWORD_DEFAULT);
                

                $this->User_model->update_user($user_id, ['password' => $new_password]);
                $this->session->set_flashdata('success', 'Password sudah berhasil diperbarui.');
                redirect($redirect);
            }
        } else {
            $this->session->set_flashdata('error', 'Gagal mengubah password user.');
            redirect($redirect);
        }
    }

    public function delete_user()
    {
        $redirect = $this->input->server('HTTP_REFERER') ?? base_url('superadmin/user_list');

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('user_id', 'user_id', 'required|trim', [
                'required' => '%s wajib diisi.'
            ]);

            if ($this->form_validation->run() === FALSE) {
                $this->session->set_flashdata('old', [
                    'user_id'  => set_value('user_id'),
                    
                ]);
                $this->session->set_flashdata('errors', [
                    'user_id'            => form_error('user_id'),
                    
                ]);
                redirect($redirect);
            } else {
                $encrypted_user_id = $this->input->post('user_id');
                $user_id = decrypt_id($encrypted_user_id);

                if (empty($user_id)) {
                    $this->session->set_flashdata('error', 'Gagal mengakses halaman, user ID tidak ada.');
                    redirect($redirect);
                }

                $user = $this->db->get_where('user', ['id' => $user_id])->row_array();
                if (!$user) {
                    $this->session->set_flashdata('error', 'Data user tidak ditemukan.');
                    redirect($redirect);
                }

                if (!empty($user['foto']) && file_exists(FCPATH . 'public/' . $user['foto'])) {
                    unlink(FCPATH . 'public/' . $user['foto']);
                }


                $this->db->delete('user', ['id' => $user_id]);
                $this->session->set_flashdata('success', 'User berhasil dihapus.');

                redirect($redirect);
            }
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus user.');
            redirect($redirect);
        }
        
    }

    public function add_new_user()
    {
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('role', 'Role', 'required|trim', [
                'required' => '%s wajib diisi.'
            ]);
            $this->form_validation->set_rules('is_active', 'User Active', 'trim');

            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', [
                'required' => '%s wajib diisi.'
            ]);
            $this->form_validation->set_rules('nomor', 'Nomor WhatsApp', 'required|numeric|min_length[10]|max_length[15]|trim', [
                'required'    => '%s wajib diisi.',
                'numeric'     => '%s harus berupa angka.',
                'min_length'  => '%s minimal 10 digit.',
                'max_length'  => '%s maksimal 15 digit.'
            ]);
            $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required|trim', [
                'required' => '%s wajib diisi.'
            ]);

            $this->form_validation->set_rules('provinsi', 'Provinsi', 'required|trim', [
                'required' => '%s wajib dipilih.'
            ]);
            $this->form_validation->set_rules('kota', 'Kota/Kabupaten', 'required|trim', [
                'required' => '%s wajib dipilih.'
            ]);
            $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required|trim', [
                'required' => '%s wajib dipilih.'
            ]);
            $this->form_validation->set_rules('kode_pos', 'Kode Pos', 'required|numeric|exact_length[5]|trim', [
                'required'     => '%s wajib diisi.',
                'numeric'      => '%s harus berupa angka.',
                'exact_length' => '%s harus terdiri dari 5 digit.'
            ]);
            $this->form_validation->set_rules('alamat_lengkap', 'Alamat Lengkap', 'required|min_length[10]|trim', [
                'required'    => '%s wajib diisi.',
                'min_length'  => '%s minimal 10 karakter.'
            ]);

            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]', [
				'required'    => '%s wajib diisi.',
				'valid_email' => 'Format %s tidak valid.',
				'is_unique'   => '%s sudah terdaftar.'
			]);
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]', [
				'required'   => '%s wajib diisi.',
				'min_length' => '%s minimal 6 karakter.'
			]);
			$this->form_validation->set_rules('repeat_password', 'Ulangi Password', 'required|matches[password]', [
				'required' => '%s wajib diisi.',
				'matches'  => '%s tidak sama dengan Password.'
			]);

            if ($this->form_validation->run() === FALSE) {
				$this->session->set_flashdata('errors', [
                    'role'            => form_error('role'),

                    'nama'            => form_error('nama'),
                    'nomor'           => form_error('nomor'),
                    'tanggal_lahir'   => form_error('tanggal_lahir'),

                    'provinsi'        => form_error('provinsi'),
                    'kota'            => form_error('kota'),
                    'kecamatan'       => form_error('kecamatan'),
                    'kode_pos'        => form_error('kode_pos'),
                    'alamat_lengkap'  => form_error('alamat_lengkap'),

                    'email'           => form_error('email'),
                    'password'        => form_error('password'),
                    'repeat_password'       => form_error('repeat_password'),
                ]);            
				$this->session->set_flashdata('old', [
                    'role'            => set_value('role'),
                    'is_active'       => set_value('is_active'),

                    'nama'            => set_value('nama'),
                    'nomor'           => set_value('nomor'),
                    'tanggal_lahir'   => set_value('tanggal_lahir'),

                    'provinsi'        => set_value('provinsi'),
                    'kota'            => set_value('kota'),
                    'kecamatan'       => set_value('kecamatan'),
                    'kode_pos'        => set_value('kode_pos'),
                    'alamat_lengkap'  => set_value('alamat_lengkap'),

                    'email'           => set_value('email'),
                    'password'        => set_value('password'),
                    'repeat_password'       => set_value('repeat_password'),
                ]);            
				redirect('superadmin/add_new_user');
			} else {
                $is_active = $this->input->post('is_active') ? 1 : 0;

                $data = [
                    'role_id' => $this->input->post('role', TRUE),
                    'is_active'  => $is_active,

                    'nama' => $this->input->post('nama', TRUE),
                    'nomor' => $this->input->post('nomor', TRUE),
                    'tanggal_lahir' => $this->input->post('tanggal_lahir', TRUE),

                    'provinsi' => $this->input->post('provinsi', TRUE),
                    'kota' => $this->input->post('kota', TRUE),
                    'kecamatan' => $this->input->post('kecamatan', TRUE),
                    'kode_pos' => $this->input->post('kode_pos', TRUE),
                    'alamat_lengkap' => $this->input->post('alamat_lengkap', TRUE),

                    'email' => $this->input->post('email', TRUE),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),

                ];
    
                if (!empty($_FILES['foto']['name'])) {
                    $config['upload_path'] = './public/web_assets/images/user_profile/';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['max_size'] = 2048;
                    $config['file_name'] = 'user_' . '_' . time(); // biar unik
    
                    $this->load->library('upload', $config);
    
                    if ($this->upload->do_upload('foto')) {
                        $uploadData = $this->upload->data();
                        $data['foto'] = 'web_assets/images/user_profile/' . $uploadData['file_name'];
    
                    } else {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect('superadmin/add_new_user');
                    }
                }
    
                $this->User_model->insert_user($data);
                $this->session->set_flashdata('success', 'Data profile berhasil diperbarui.');

                $role = $this->db->get_where('role', ['role_id' => $this->input->post('role', TRUE)])->row_array();

                $jabatan_slug = strtolower(str_replace(' ', '-', $role['jabatan']));
                redirect('superadmin/user_list_role/' . $jabatan_slug);
			}
        }

        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();

        $data['title'] = 'Add New User';

        $data['errors'] = $this->session->flashdata('errors') ?? [];
        $data['old'] = $this->session->flashdata('old') ?? [];

        $data['role_list'] = $this->db->get('role')->result_array();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('layout/sidebar', $data);
		$this->load->view('superadmin/user/add_new_user', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
    }





    
}

?>