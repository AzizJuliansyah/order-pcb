<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
	public function __construct()
    {
        parent::__construct();
		

        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

	public function index()
	{
		redirect('auth/login');
	}
    
	public function login()
	{
		is_guest_redirect();

		if ($this->input->method() === 'post') {
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim', [
				'required'    => '%s wajib diisi.',
				'valid_email' => 'Format %s tidak valid.',
			]);
			$this->form_validation->set_rules('password', 'Password', 'required|trim', [
				'required' => '%s wajib diisi.',
			]);

			if ($this->form_validation->run() === FALSE) {
				$this->session->set_flashdata('old', [
					'email' => set_value('email')
				]);
				$this->session->set_flashdata('errors', [
					'email'    => form_error('email'),
					'password' => form_error('password')
				]);
				redirect('auth/login');
			} else {
				$email = $this->input->post('email', TRUE);
				$password = $this->input->post('password', TRUE);

				$user = $this->db->get_where('user', ['email' => $email])->row_array();

				if ($user) {
					if (password_verify($password, $user['password'])) {
						$this->session->set_userdata([
							'user_id' => $user['id'],
							'nama'    => $user['nama'],
							'email'   => $user['email'],
							'role_id'   => $user['role_id'],
						]);
						$this->session->set_flashdata('success', 'Anda telah berhasil login!');
						redirect('home');
					} else {
						$this->session->set_flashdata('old', [
							'email' => $email,
						]);
						$this->session->set_flashdata('errors', [
							'password' => 'Password salah'
						]);
						$this->session->set_flashdata('old', ['email' => $email]);
						redirect('auth/login');
					}
				} else {
					$this->session->set_flashdata('old', [
						'email' => $email,
					]);
					$this->session->set_flashdata('errors', [
						'email'    => 'Email tidak terdaftar',
					]);
					redirect('auth/login');
				}
			}
		}

		$data['old']    = $this->session->flashdata('old') ?? [];
		$data['errors'] = $this->session->flashdata('errors') ?? [];

		$data['title'] = 'Login Page';
		$this->load->view('layout/header', $data);
		$this->load->view('layout/alert');
		$this->load->view('auth/login', $data);
		$this->load->view('layout/footer');
	}


	public function register()
	{
		is_guest_redirect();

		if ($this->input->method() === 'post') {
			$this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
				'required' => '%s wajib diisi.'
			]);
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]', [
				'required'    => '%s wajib diisi.',
				'valid_email' => 'Format %s tidak valid.',
				'is_unique'   => '%s sudah terdaftar.'
			]);
			$this->form_validation->set_rules('nomor', 'Nomor Telepon', 'required|numeric', [
				'required' => '%s wajib diisi.',
				'numeric'  => '%s harus berupa angka.'
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
				$this->session->set_flashdata('old', [
					'nama'  => set_value('nama'),
					'email' => set_value('email'),
					'nomor' => set_value('nomor'),
				]);
				$this->session->set_flashdata('errors', [
					'nama'            => form_error('nama'),
					'email'           => form_error('email'),
					'nomor'           => form_error('nomor'),
					'password'        => form_error('password'),
					'repeat_password' => form_error('repeat_password'),
				]);
				redirect('auth/register');
			} else {
				$data = [
					'nama'     => $this->input->post('nama', TRUE),
					'email'    => $this->input->post('email', TRUE),
					'nomor'    => $this->input->post('nomor', TRUE),
					'role_id' => 5,
					'is_active' => 1,
					'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				];
				$this->User_model->insert_user($data);
				$this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login.');
				redirect('auth/login');
			}
		}
	
		$data['old'] = $this->session->flashdata('old') ?? [];
		$data['errors'] = $this->session->flashdata('errors') ?? [];

		$data['title'] = 'Register Page';
		$this->load->view('layout/header', $data);
		$this->load->view('layout/alert');
		$this->load->view('auth/register', $data);
		$this->load->view('layout/footer');
	}
	
	public function logout()
	{
		$this->session->set_flashdata('success', 'Anda telah berhasil logout.');
		$this->session->sess_regenerate(TRUE);
		$this->session->unset_userdata(['user_id', 'nama', 'email', 'role_id']);

		redirect('auth/login');
	}

	public function forgot_password()
	{
		if ($this->input->method() === 'post') {
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim', [
				'required'    => '%s wajib diisi.',
				'valid_email' => 'Format %s tidak valid.',
			]);

			if ($this->form_validation->run() === FALSE) {
				$this->session->set_flashdata('old', [
					'email' => set_value('email')
				]);
				$this->session->set_flashdata('errors', [
					'email'    => form_error('email'),
				]);
				redirect('auth/forgot_password');
			} else {
				$email = $this->input->post('email', TRUE);

				$user = $this->db->get_where('user', ['email' => $email])->row_array();

				if ($user) {
					// Membuat token reset password
					$token = bin2hex(random_bytes(50)); // Buat token unik

					// Simpan token di database, misalnya di tabel password_resets
					$this->db->insert('password_resets', [
						'email' => $email,
						'token' => $token,
					]);

					// Kirim email dengan link reset password
					$reset_link = base_url("auth/reset_password/$token");

					$subject = 'Reset Password Request';
					$message = "Anda telah meminta untuk mereset password. Silakan klik link berikut untuk mereset password Anda:\n\n";
					$message .= $reset_link;

					// Kirim email menggunakan library email CodeIgniter
					$this->load->library('email', $this->config->item('email'));
					$this->email->from('azizjuliansyah234@gmail.com', 'Your App Name');
					$this->email->to($email);
					$this->email->subject($subject);
					$this->email->message($message);

					if ($this->email->send()) {
						$this->session->set_flashdata('success', 'Link reset password telah dikirim ke email Anda.');
					} else {
						$this->session->set_flashdata('error', 'Gagal mengirim email, coba lagi nanti.');
					}

					redirect('auth/forgot_password');
				} else {
					$this->session->set_flashdata('old', [
						'email' => $email,
					]);
					$this->session->set_flashdata('errors', [
						'email' => 'Email tidak terdaftar',
					]);
					redirect('auth/forgot_password');
				}
			}
		}

		if ($this->session->userdata('user_id')) {
			$user_id = $this->session->userdata('user_id');
			$data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();
			$data['role'] = $this->User_model->get_user_with_role($user_id);
		}

		$data['title'] = 'Forgot Password';
		$data['has_sidebar'] = false;

		$data['old']    = $this->session->flashdata('old') ?? [];
		$data['errors'] = $this->session->flashdata('errors') ?? [];

		$this->load->view('layout/header', $data);
		$this->load->view('auth/forgot_password', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
	}


	public function reset_password1($token)
	{
		// Cek apakah token valid
		$reset = $this->db->get_where('password_resets', ['token' => $token])->row_array();

		if ($reset) {
			// Tampilkan form reset password
			if ($this->input->method() === 'post') {
				$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[50]', [
					'required' => '%s wajib diisi.',
					'min_length' => '%s minimal 6 karakter.',
					'max_length' => '%s maksimal 50 karakter.',
				]);

				if ($this->form_validation->run() === FALSE) {
					$this->session->set_flashdata('errors', validation_errors());
					redirect("auth/reset_password/$token");
				} else {
					$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

					// Update password pengguna
					$this->db->update('user', ['password' => $password], ['email' => $reset['email']]);

					// Hapus token setelah password diubah
					$this->db->delete('password_resets', ['token' => $token]);

					$this->session->set_flashdata('message', 'Password Anda telah berhasil diubah.');
					redirect('auth/login');
				}
			}

			$data['title'] = 'Reset Password';
			$data['token'] = $token;
			$this->load->view('layout/header', $data);
			$this->load->view('auth/reset_password', $data);
			$this->load->view('layout/footer');
		} else {
			$this->session->set_flashdata('message', 'Token reset password tidak valid atau sudah kadaluarsa.');
			redirect('auth/forgot_password');
		}
	}

	public function reset_password()
	{
		

			$data['title'] = 'Reset Password';
			$this->load->view('layout/header', $data);
			$this->load->view('auth/reset_password', $data);
			$this->load->view('layout/footer');
	}

}
