<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        is_logged_in(); // panggil fungsi middleware ini di setiap controller yang ingin diamankan
    }
    
	public function index()
	{
		$this->load->view('home/index');
	}
    
	public function tes()
	{
		echo 'pepessk';
	}
}
