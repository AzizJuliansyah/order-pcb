<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {
    
	public function __construct()
    {
        parent::__construct();
        is_logged_in();
        check_access(['1']);

        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function user_list()
    {
        $user_id = $this->session->userdata('user_id');

        $data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();
        $data['role'] = $this->User_model->get_user_with_role($user_id);

        $data['title'] = 'User List';

        $data['errors'] = $this->session->flashdata('errors') ?? [];
        $data['old'] = $this->session->flashdata('old') ?? [];

        $data['role_list'] = $this->db->get('role')->result_array();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('administrator/user/user_list', $data);
        $this->load->view('layout/alert');
        $this->load->view('layout/footer');
    }

    public function user_list_role()
    {
        $user_id = $this->session->userdata('user_id');

        $data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();
        $data['role'] = $this->User_model->get_user_with_role($user_id);

        $data['title'] = 'User List Per Role';

        $data['errors'] = $this->session->flashdata('errors') ?? [];
        $data['old'] = $this->session->flashdata('old') ?? [];

        $data['role_list'] = $this->db->get('role')->result_array();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('administrator/user/user_list_role', $data);
        $this->load->view('layout/alert');
        $this->load->view('layout/footer');
    }

    public function add_new_user()
    {
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('role', 'Role', 'required|trim', [
                'required' => '%s wajib diisi.'
            ]);

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
				redirect('administrator/add_new_user');
			} else {
                $data = [
                    'role' => $this->input->post('role', TRUE),

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
                        redirect('administrator/add_new_user');
                    }
                }
    
                $this->User_model->insert_user($data);
                $this->session->set_flashdata('success', 'Data profile berhasil diperbarui.');
                redirect('user/profile');
			}
        }

        $user_id = $this->session->userdata('user_id');
    
        $data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();
        $data['role'] = $this->User_model->get_user_with_role($user_id);

        $data['title'] = 'Add New User';

        $data['errors'] = $this->session->flashdata('errors') ?? [];
        $data['old'] = $this->session->flashdata('old') ?? [];

        $data['role_list'] = $this->db->get('role')->result_array();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('layout/sidebar', $data);
		$this->load->view('administrator/user/add_new_user', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
    }

}

?>