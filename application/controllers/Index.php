<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

		$this->load->model('User_model');
    }
    
	public function home()
	{
		if ($this->session->userdata('user_id')) {
			$user_id = $this->session->userdata('user_id');

			$user = $this->db->get_where('user', ['id' => $user_id])->row_array();
			$data['user'] = $user;
			$data['role_id'] = $user['role_id'];
		}

		$data['title'] = 'Home';

		$data['has_sidebar'] = false;

		$this->load->view('index/home', $data);
		$this->load->view('layout/alert');
	}

	public function landingpage()
	{
		if ($this->session->userdata('user_id')) {
			$user_id = $this->session->userdata('user_id');

			$user = $this->db->get_where('user', ['id' => $user_id])->row_array();
			$data['user'] = $user;
			$data['role_id'] = $user['role_id'];
		}

		$data['title'] = 'Landing Page';

		$data['has_sidebar'] = false;

		$this->load->view('index/landingpage', $data);
		$this->load->view('layout/alert');
	}
    
}
