<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
	public function __construct()
    {
        parent::__construct();
		
		date_default_timezone_set('Asia/Jakarta');
		require_once APPPATH . '../vendor/autoload.php';

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

		$data['old']    = $this->session->flashdata('old') ?? [];
		$data['errors'] = $this->session->flashdata('errors') ?? [];

		$data['title'] = 'Login Page';

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
					if ($user['is_active'] != 1) {
						$this->session->set_flashdata('old', ['email' => $email]);
						$this->session->set_flashdata('errors', [
							'email' => ' '
						]);
						$this->session->set_flashdata('error', 'Akun Anda belum aktif atau dinonaktifkan.');
						redirect('auth/login');
					}

					if (password_verify($password, $user['password'])) {
						$this->session->set_userdata([
							'user_id' => $user['id'],
							'nama'    => $user['nama'],
							'email'   => $user['email'],
							'role_id' => $user['role_id'],
						]);
						$this->session->set_flashdata('success', 'Anda telah berhasil login!');

						switch ($user['role_id']) {
							case 1:
								redirect('superadmin/dashboard'); // Superadmin
								break;
							case 2:
								redirect('admin/dashboard'); // Vendor Admin
								break;
							case 3:
								redirect('operator/dashboard'); // Vendor Operator
								break;
							case 4:
								redirect('customerservice/dashboard'); // Customer Service
								break;
							case 5:
								redirect('customer/dashboard'); // Customer
								break;
							default:
								redirect('home'); // fallback
						}
					} else {
						$this->session->set_flashdata('old', ['email' => $email]);
						$this->session->set_flashdata('errors', [
							'password' => 'Password salah'
						]);
						redirect('auth/login');
					}
				} else {
					$this->session->set_flashdata('old', ['email' => $email]);
					$this->session->set_flashdata('errors', [
						'email' => 'Email tidak terdaftar',
					]);
					redirect('auth/login');
				}
			}
		}
		
		$this->load->view('layout/header', $data);
		$this->load->view('layout/alert');
		$this->load->view('auth/login', $data);
		$this->load->view('layout/footer');
	}

	public function login_google()
	{
		$google_id = $this->db->get_where('settings', ['id' => '1'])->row_array()['item'];
		$google_secret = $this->db->get_where('settings', ['id' => '2'])->row_array()['item'];

		$client = new Google_Client();
		$client->setClientId($google_id);
		$client->setClientSecret($google_secret);
		$client->setRedirectUri(base_url('auth/google_callback'));
		$client->addScope('email');
		$client->addScope('profile');

		$auth_url = $client->createAuthUrl();
		redirect($auth_url);
	}


	public function google_callback()
	{
		$google_id = $this->db->get_where('settings', ['id' => '1'])->row_array()['item'];
		$google_secret = $this->db->get_where('settings', ['id' => '2'])->row_array()['item'];

		$client = new Google_Client();
		$client->setClientId($google_id);
		$client->setClientSecret($google_secret);
		$client->setRedirectUri(base_url('auth/google_callback'));

		if ($this->input->get('code')) {
			$token = $client->fetchAccessTokenWithAuthCode($this->input->get('code'));
			$client->setAccessToken($token);

			$oauth = new Google_Service_Oauth2($client);
			$userinfo = $oauth->userinfo->get();
			$email = $userinfo->email;
			$name = $userinfo->name;
			$user = $this->db->get_where('user', ['email' => $email])->row_array();

			if ($user) {
				$this->session->set_userdata([
					'user_id' => $user['id'],
					'nama'    => $user['nama'],
					'email'   => $user['email'],
					'role_id' => $user['role_id']
				]);
			} else {
				$this->db->insert('user', [
					'nama'     => $name,
					'email'    => $email,
					'password' => password_hash(uniqid(), PASSWORD_DEFAULT),
					'role_id'  => 5,
					'is_active' => 1,
				]);

				$user_id = $this->db->insert_id();
				$this->session->set_userdata([
					'user_id' => $user_id,
					'nama'    => $name,
					'email'   => $email,
					'role_id' => 5
				]);
			}

			$this->session->set_flashdata('success', 'Berhasil login dengan Google.');
			redirect('customer/dashboard');
		} else {
			$this->session->set_flashdata('error', 'Login Google gagal.');
			redirect('auth/login');
		}
	}

	public function register()
	{
		is_guest_redirect();

		$data['old'] = $this->session->flashdata('old') ?? [];
		$data['errors'] = $this->session->flashdata('errors') ?? [];

		$data['title'] = 'Register Page';

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
		is_guest_redirect();
		
		if ($this->session->userdata('user_id')) {
			$user_id = $this->session->userdata('user_id');
			$data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();
			$data['role'] = $this->User_model->get_user_with_role($user_id);
		}
		
		$data['old']    = $this->session->flashdata('old') ?? [];
		$data['errors'] = $this->session->flashdata('errors') ?? [];

		$data['title'] = 'Forgot Password';

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
					$token = bin2hex(random_bytes(50));

					$this->db->delete('password_resets', ['email' => $email]);
					$this->db->insert('password_resets', [
						'email' => $email,
						'token' => $token,
					]);

					$reset_link = base_url("auth/reset_password/$token");
					$this->_sendEmail($email, $reset_link);
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
		
		$data['has_sidebar'] = false;
		$this->load->view('layout/header', $data);
		$this->load->view('auth/forgot_password', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
	}

	private function _sendEmail($email, $reset_link)
	{
		$config = [
			'protocol'     => 'smtp',
			'smtp_host'    => 'smtp.gmail.com',
			'smtp_user'    => 'azizjuliansyah234@gmail.com',
			'smtp_pass'    => 'xpyniefrflrcmnsb',
			'smtp_port'    => 587,
			'smtp_crypto'  => 'tls',
			'mailtype'     => 'html',
			'charset'      => 'utf-8',
			'newline'      => "\r\n",
			'crlf'         => "\r\n",
		];

		$this->load->library('email');
		$this->email->initialize($config);

		$this->email->from('azizjuliansyah234@gmail.com', 'Aziz');
		$this->email->to($email);
		$this->email->subject('Reset Password');

		$message = '
			<div style="font-family: Arial, sans-serif; max-width: 600px; margin: auto; border: 1px solid #eee; padding: 20px; border-radius: 10px;">
				<h2 style="color: #333;">Reset Password Anda</h2>
				<p>Halo, "' . $email . '"</p>
				<p>Kami menerima permintaan untuk mereset password akun Anda.</p>
				<p>Silakan klik tombol di bawah ini untuk mengganti password Anda:</p>
				
				<div style="text-align: center; margin: 30px 0;">
					<a href="' . $reset_link . '" style="
						background-color: #007bff;
						color: white;
						padding: 12px 25px;
						text-decoration: none;
						border-radius: 5px;
						display: inline-block;
						font-weight: bold;
					">Reset Password</a>
				</div>

				<p>Jika tombol di atas tidak bisa diklik, salin dan buka link berikut di browser Anda:</p>
				<p style="word-break: break-all;"><a href="' . $reset_link . '">' . $reset_link . '</a></p>

				<hr style="margin: 30px 0;">
				<p style="font-size: 12px; color: #888;">
					Jika Anda tidak merasa melakukan permintaan ini, Anda dapat mengabaikan email ini.
				</p>
				<p style="font-size: 12px; color: #888;">Terima kasih,<br>Tim Support Aziz</p>
			</div>';

		$this->email->message($message);

		if ($this->email->send()) {
			$this->session->set_flashdata('success', 'Link reset password telah dikirim ke email Anda.');
		} else {
			$this->session->set_flashdata('error', 'Gagal mengirim email, coba lagi nanti.');
		}
	}



	public function reset_password($token = null)
	{
		is_guest_redirect();

		if (!$token) {
			$this->session->set_flashdata('error', 'Token reset password tidak valid.');
			redirect('auth/forgot_password');
		}

		$reset = $this->db->get_where('password_resets', ['token' => $token])->row_array();

		if ($reset) {
			$created_at = strtotime($reset['created_at']);
			$now = time();

			if ($now - $created_at > 86400) { // 86400 detik = 24 jam
				$this->db->delete('password_resets', ['token' => $token]);
				$this->session->set_flashdata('error', 'Token sudah kedaluwarsa.');
				redirect('auth/forgot_password');
			}

			if ($this->input->method() === 'post') {
				$this->form_validation->set_rules('npassword', 'New Password', 'required|trim|min_length[6]|max_length[50]', [
					'required'   => '%s wajib diisi.',
					'min_length' => '%s minimal 6 karakter.',
					'max_length' => '%s maksimal 50 karakter.',
				]);

				$this->form_validation->set_rules('vpassword', 'Verify Password', 'required|trim|matches[npassword]', [
					'required' => '%s wajib diisi.',
					'matches'  => '%s tidak cocok dengan New Password.'
				]);

				if ($this->form_validation->run() === FALSE) {
					$this->session->set_flashdata('errors', [
						'npassword' => form_error('npassword'),
						'vpassword' => form_error('vpassword'),
					]);
					$this->session->set_flashdata('old', [
						'npassword' => set_value('npassword'),
						'vpassword' => set_value('vpassword'),
					]);
					redirect("auth/reset_password/" . $token);
				} else {
					$password = password_hash($this->input->post('npassword'), PASSWORD_DEFAULT);

					$this->db->update('user', ['password' => $password], ['email' => $reset['email']]);
					$this->db->delete('password_resets', ['token' => $token]);

					$this->session->set_flashdata('success', 'Password Anda telah berhasil diubah.');
					redirect('auth/login');
				}
			}

			$data['title'] = 'Reset Password';
			$data['token'] = $token;
			$data['old'] = $this->session->flashdata('old') ?? [];
			$data['errors'] = $this->session->flashdata('errors') ?? [];

			$this->load->view('layout/header', $data);
			$this->load->view('auth/reset_password', $data);
			$this->load->view('layout/footer');
		} else {
			$this->session->set_flashdata('error', 'Token reset password tidak valid atau sudah kadaluarsa.');
			redirect('auth/forgot_password');
		}
	}

}
