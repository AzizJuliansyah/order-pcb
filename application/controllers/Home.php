	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        is_logged_in();

		$this->load->model('User_model');
    }
    
	public function index()
	{
		$user_id = $this->session->userdata('user_id');

		$data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();
		$data['role'] = $this->User_model->get_user_with_role($user_id);

		$data['title'] = 'Home';

		$data['has_sidebar'] = false;

		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('home/index', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
	}
    
	public function tes()
	{
		echo 'pepessk';
	}
}
