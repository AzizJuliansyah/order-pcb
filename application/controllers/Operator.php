<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operator extends CI_Controller {
    
	public function __construct()
    {
        parent::__construct();
        is_logged_in();
        check_access(['3']);

        $this->load->helper('time');

        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function dashboard()
	{
		$user_id = $this->session->userdata('user_id');
		$data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();

		$data['title'] = 'Operator Dashboard';
        

		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
        $this->load->view('layout/sidebar', $data);
		$this->load->view('operator/dashboard', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
	}

	public function order_list()
	{
		$user_id = $this->session->userdata('user_id');
		$data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();
		$data['title'] = 'Order List Page';

		
		$keyword = $this->input->post('q');

		$dari = $this->input->post('dari');
		$sampai = $this->input->post('sampai');

		$page = (int) $this->input->get('page');
		$page = $page < 1 ? 1 : $page;

		$limit = 10;
		$offset = ($page - 1) * $limit;

		$this->db->from('orders');
		$this->db->join('user', 'user.id = orders.user_id', 'left');
		$this->db->where('orders.operator', $user_id);
		
		if (!empty($keyword)) {
			$this->db->group_start();
			$this->db->like('user.nama', $keyword);
			$this->db->or_like('user.email', $keyword);
			$this->db->or_like('orders.order_code', $keyword);
			$this->db->group_end();
		}
		if (!empty($dari) && !empty($sampai) && strtotime($dari) && strtotime($sampai)) {
			$this->db->where("DATE(orders.date_created) BETWEEN '$dari' AND '$sampai'");
		}
		$total_rows = $this->db->count_all_results();

		$this->db->select('orders.*, user.nama, user.email, user.foto');
		$this->db->from('orders');
		$this->db->join('user', 'user.id = orders.user_id', 'left');
		$this->db->where('orders.operator', $user_id);
		
		if (!empty($keyword)) {
			$this->db->group_start();
			$this->db->like('user.nama', $keyword);
			$this->db->or_like('user.email', $keyword);
			$this->db->or_like('orders.order_code', $keyword);
			$this->db->group_end();
		}
		if (!empty($dari) && !empty($sampai) && strtotime($dari) && strtotime($sampai)) {
			$this->db->where("DATE(orders.date_created) BETWEEN '$dari' AND '$sampai'");
		}
		$this->db->order_by('orders.date_created', 'DESC');
		$this->db->limit($limit, $offset);
		$data['orders'] = $this->db->get()->result_array();

		// Pagination
		$config['base_url'] = base_url('operator/order_list');
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $limit;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'page';
		$config['reuse_query_string'] = TRUE;
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open']   = '<ul class="pagination">';
		$config['full_tag_close']  = '</ul>';
		$config['first_link']      = 'First';
		$config['first_tag_open']  = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['last_link']       = 'Last';
		$config['last_tag_open']   = '<li class="page-item">';
		$config['last_tag_close']  = '</li>';
		$config['next_link']       = 'Next';
		$config['next_tag_open']   = '<li class="page-item">';
		$config['next_tag_close']  = '</li>';
		$config['prev_link']       = 'Previous';
		$config['prev_tag_open']   = '<li class="page-item">';
		$config['prev_tag_close']  = '</li>';
		$config['cur_tag_open']    = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close']   = ' <span class="sr-only">(current)</span></a></li>';
		$config['num_tag_open']    = '<li class="page-item">';
		$config['num_tag_close']   = '</li>';
		$config['attributes'] = ['class' => 'page-link'];

		$this->pagination->initialize($config);
		$data['pagination_links'] = $this->pagination->create_links();

		// Untuk menyimpan input ke view
		
		$data['search_keyword'] = $keyword;
		$data['dari'] = $dari;
		$data['sampai'] = $sampai;

		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('operator/order/order_list', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
	}


	public function order_list_today()
	{
		$user_id = $this->session->userdata('user_id');
		$data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();
		$data['title'] = 'Order List Page';

		$keyword = $this->input->post('q');

		$dari = date('Y-m-d');
		$sampai = date('Y-m-d');

		$page = (int) $this->input->get('page');
		$page = $page < 1 ? 1 : $page;

		$limit = 10;
		$offset = ($page - 1) * $limit;

		$this->db->from('orders');
		$this->db->join('user', 'user.id = orders.user_id', 'left');
		$this->db->where('orders.operator', $user_id);
		
		if (!empty($keyword)) {
			$this->db->group_start();
			$this->db->like('user.nama', $keyword);
			$this->db->or_like('user.email', $keyword);
			$this->db->or_like('orders.order_code', $keyword);
			$this->db->group_end();
		}
		$this->db->where("DATE(orders.date_created) BETWEEN '$dari' AND '$sampai'");
		$total_rows = $this->db->count_all_results();

		$this->db->select('orders.*, user.nama, user.email, user.foto');
		$this->db->from('orders');
		$this->db->join('user', 'user.id = orders.user_id', 'left');
		$this->db->where('orders.operator', $user_id);
		
		if (!empty($keyword)) {
			$this->db->group_start();
			$this->db->like('user.nama', $keyword);
			$this->db->or_like('user.email', $keyword);
			$this->db->or_like('orders.order_code', $keyword);
			$this->db->group_end();
		}
		$this->db->where("DATE(orders.date_created) BETWEEN '$dari' AND '$sampai'");
		$this->db->order_by('orders.date_created', 'DESC');
		$this->db->limit($limit, $offset);
		$data['orders'] = $this->db->get()->result_array();

		// Pagination
		$config['base_url'] = base_url('admin/order_list');
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $limit;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'page';
		$config['reuse_query_string'] = TRUE;
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open']   = '<ul class="pagination">';
		$config['full_tag_close']  = '</ul>';
		$config['first_link']      = 'First';
		$config['first_tag_open']  = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['last_link']       = 'Last';
		$config['last_tag_open']   = '<li class="page-item">';
		$config['last_tag_close']  = '</li>';
		$config['next_link']       = 'Next';
		$config['next_tag_open']   = '<li class="page-item">';
		$config['next_tag_close']  = '</li>';
		$config['prev_link']       = 'Previous';
		$config['prev_tag_open']   = '<li class="page-item">';
		$config['prev_tag_close']  = '</li>';
		$config['cur_tag_open']    = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close']   = ' <span class="sr-only">(current)</span></a></li>';
		$config['num_tag_open']    = '<li class="page-item">';
		$config['num_tag_close']   = '</li>';
		$config['attributes'] = ['class' => 'page-link'];

		$this->pagination->initialize($config);
		$data['pagination_links'] = $this->pagination->create_links();

		// Untuk menyimpan input ke view
		$data['search_keyword'] = $keyword;

		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('operator/order/order_list_today', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
	}
}

?>