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
		$this->load->view('home/index');
	}
    
	public function login()
	{
        $this->load->view('layout/header');
		$this->load->view('layout/alert');
        $this->load->view('auth/login');
        $this->load->view('layout/footer');
	}

	public function register()
	{
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

		$this->load->view('layout/header');
		$this->load->view('layout/alert');
		$this->load->view('auth/register', $data);
		$this->load->view('layout/footer');
	}
	


}
