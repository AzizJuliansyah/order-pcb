<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    
	public function __construct()
    {
        parent::__construct();
        is_logged_in();
        
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

	public function profile()
	{
        $user_id = $this->session->userdata('user_id');
    
        $data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();
        $data['role'] = $this->User_model->get_user_with_role($user_id);

        $data['title'] = 'User profile';

        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('layout/sidebar', $data);
		$this->load->view('user/profile', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
	}

	public function edit_profile()
	{
        $user_id = $this->session->userdata('user_id');
    
        $data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();
        $data['role'] = $this->User_model->get_user_with_role($user_id);

        $data['title'] = 'Edit profile';

        $data['errors'] = $this->session->flashdata('errors') ?? [];
        $data['old'] = $this->session->flashdata('old') ?? [];

        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('layout/sidebar', $data);
		$this->load->view('user/edit_profile', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
	}

    public function edit_personal_info()
    {
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', [
                'required' => '%s wajib diisi.'
            ]);
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim', [
                'required'    => '%s wajib diisi.',
                'valid_email' => 'Format %s tidak valid.'
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

            if ($this->form_validation->run() === FALSE) {
				$this->session->set_flashdata('errors', [
                    'nama'            => form_error('nama'),
                    'email'           => form_error('email'),
                    'nomor'           => form_error('nomor'),
                    'tanggal_lahir'   => form_error('tanggal_lahir'),
                    'provinsi'        => form_error('provinsi'),
                    'kota'            => form_error('kota'),
                    'kecamatan'       => form_error('kecamatan'),
                    'kode_pos'        => form_error('kode_pos'),
                    'alamat_lengkap'  => form_error('alamat_lengkap'),
                ]);                
				$this->session->set_flashdata('old', [
                    'nama'            => set_value('nama'),
                    'email'           => set_value('email'),
                    'nomor'           => set_value('nomor'),
                    'tanggal_lahir'   => set_value('tanggal_lahir'),
                    'provinsi'        => set_value('provinsi'),
                    'kota'            => set_value('kota'),
                    'kecamatan'       => set_value('kecamatan'),
                    'kode_pos'        => set_value('kode_pos'),
                    'alamat_lengkap'  => set_value('alamat_lengkap'),
                ]);                
				redirect('user/edit_profile');
			} else {
				$user_id = $this->session->userdata('user_id');

                $user = $this->db->get_where('user', ['id' => $user_id])->row_array();
    
                $data = [
                    'nama' => $this->input->post('nama', TRUE),
                    'email' => $this->input->post('email', TRUE),
                    'nomor' => $this->input->post('nomor', TRUE),
                    'tanggal_lahir' => $this->input->post('tanggal_lahir', TRUE),
                    'provinsi' => $this->input->post('provinsi', TRUE),
                    'kota' => $this->input->post('kota', TRUE),
                    'kecamatan' => $this->input->post('kecamatan', TRUE),
                    'kode_pos' => $this->input->post('kode_pos', TRUE),
                    'alamat_lengkap' => $this->input->post('alamat_lengkap', TRUE),
                ];
    
                if (!empty($_FILES['foto']['name'])) {
                    $config['upload_path'] = './public/web_assets/images/user_profile/';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['max_size'] = 2048;
                    $config['file_name'] = 'user_' . $user_id . '_' . time(); // biar unik
    
                    $this->load->library('upload', $config);
    
                    if ($this->upload->do_upload('foto')) {
                        $uploadData = $this->upload->data();
                        $data['foto'] = 'web_assets/images/user_profile/' . $uploadData['file_name'];
    
                        if (!empty($user['foto']) && file_exists('./public/' . $user['foto'])) {
                            unlink('./public/' . $user['foto']);
                        }
                    } else {
                        $this->session->set_flashdata('upload_error', $this->upload->display_errors());
                        redirect('user/edit_profile');
                    }
                }
    
                $this->User_model->update_user($user_id, $data);
                $this->session->set_flashdata('success', 'Data profile berhasil diperbarui.');
                redirect('user/profile');
			}
        } else {
            redirect('user/profile');
        }
    }

    public function change_password()
    {
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('cpassword', 'Current Password', 'required|trim|callback_check_current_password', [
                'required' => '%s wajib diisi.'
            ]);

            $this->form_validation->set_rules('npassword', 'New Password', 'required|trim|min_length[6]', [
                'required'   => '%s wajib diisi.',
                'min_length' => '%s minimal 6 karakter.'
            ]);

            $this->form_validation->set_rules('vpassword', 'Verify Password', 'required|trim|matches[npassword]', [
                'required' => '%s wajib diisi.',
                'matches'  => '%s tidak cocok dengan New Password.'
            ]);


            if ($this->form_validation->run() === FALSE) {
				$this->session->set_flashdata('errors', [
                    'cpassword'           => form_error('cpassword'),
                    'npassword'           => form_error('npassword'),
                    'vpassword'           => form_error('vpassword'),
                ]);
                $this->session->set_flashdata('old', [
                    'cpassword'           => set_value('cpassword'),
                    'npassword'           => set_value('npassword'),
                    'vpassword'           => set_value('vpassword'),
                ]);

                $this->session->set_flashdata('active_tab', 'change-pwd');

				redirect('user/edit_profile');
			} else {
                $user_id = $this->session->userdata('user_id');
                $new_password = password_hash($this->input->post('npassword'), PASSWORD_DEFAULT);

                $this->User_model->update_user($user_id, ['password' => $new_password]);

                $this->session->set_flashdata('success', 'Password sudah berhasil diperbarui.');
                redirect('user/profile');
			}
        } else {
            redirect('user/profile');
        }
    }

    public function check_current_password($input)
    {
        $user_id = $this->session->userdata('user_id');
        $user = $this->User_model->get_user_by_id($user_id);

        if (!password_verify($input, $user['password'])) {
            $this->form_validation->set_message('check_current_password', 'Password saat ini salah.');
            return FALSE;
        }
        return TRUE;
    }

}