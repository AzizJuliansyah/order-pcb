<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    
	public function __construct()
    {
        parent::__construct();
        is_logged_in();
        check_access(['2']);

        $this->load->helper('time');

        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function dashboard()
	{
		$user_id = $this->session->userdata('user_id');
		$data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();

		$data['title'] = 'Admin Dashboard';
        

		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
        $this->load->view('layout/sidebar', $data);
		$this->load->view('admin/dashboard', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
	}

    public function order_management()
	{
		$user_id = $this->session->userdata('user_id');
		$data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();
		$data['title'] = 'Order Management Page';

		$payment_status = $this->input->get('payment_status');
		$order_status = $this->input->get('order_status');
		$keyword = $this->input->get('q');

		$this->db->select('orders.*, user.nama, user.email, user.foto');
		$this->db->from('orders');
		$this->db->join('user', 'user.id = orders.user_id', 'left');

		if (!empty($payment_status)) {
			$this->db->where('orders.payment_status', $payment_status);
		}
		if (!empty($order_status)) {
			$this->db->where('orders.order_status', $order_status);
		}
		if (!empty($keyword)) {
			$this->db->group_start();
			$this->db->like('user.nama', $keyword);
			$this->db->or_like('user.email', $keyword);
			$this->db->or_like('orders.order_code', $keyword);
			$this->db->group_end();
		}

		$this->db->order_by('orders.date_created', 'DESC');
		$data['orders'] = $this->db->get()->result_array();


		$data['selected_payment_status'] = $payment_status;
		$data['selected_order_status'] = $order_status;
		$data['search_keyword'] = $keyword;

		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('admin/order/order_management', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
	}


    public function order_list()
	{
		$user_id = $this->session->userdata('user_id');
		$data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();
		$data['title'] = 'Order List Page';

		$payment_status = $this->input->get('payment_status');
		$order_status = $this->input->get('order_status');
		$keyword = $this->input->get('q');
		$page = (int) $this->input->get('page');
		$page = $page < 1 ? 1 : $page;

		$limit = 1;
		$offset = ($page - 1) * $limit;

		$this->db->from('orders');
		$this->db->join('user', 'user.id = orders.user_id', 'left');

		if (!empty($payment_status)) {
			$this->db->where('orders.payment_status', $payment_status);
		}
		if (!empty($order_status)) {
			$this->db->where('orders.order_status', $order_status);
		}
		if (!empty($keyword)) {
			$this->db->group_start();
			$this->db->like('user.nama', $keyword);
			$this->db->or_like('user.email', $keyword);
			$this->db->or_like('orders.order_code', $keyword);
			$this->db->group_end();
		}

		$total_query = clone $this->db;
		$total_rows = $total_query->count_all_results();

		$this->db->select('orders.*, user.nama, user.email, user.foto');
		$this->db->order_by('orders.date_created', 'DESC');
		$this->db->limit($limit, $offset);
		$data['orders'] = $this->db->get()->result_array();

		// Pagination config
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

		$data['selected_payment_status'] = $payment_status;
		$data['selected_order_status'] = $order_status;
		$data['search_keyword'] = $keyword;

		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('admin/order/order_list', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
	}


    public function order_detail()
	{
		if ($this->input->method() === 'post') {
			$this->form_validation->set_rules('order_id', 'order_id', 'required|trim', [
				'required' => '%s wajib diisi.'
			]);
			if ($this->form_validation->run() === FALSE) {
				$this->session->set_flashdata('error', 'Gagal mengakses halaman, Order ID tidak ada.');
				redirect("admin/order_list");
			} else {
				$user_id = $this->session->userdata('user_id');
				$data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();
				$data['title'] = 'Order List Page';

				

				$this->db->select('orders.*, user.nama, user.email, user.foto,
					COALESCE(total.total_price, 0) as total_price');
				$this->db->from('orders');
				$this->db->join('user', 'user.id = orders.user_id', 'left');
				$this->db->join('(
					SELECT order_id, SUM(total_price) as total_price 
					FROM order_items 
					GROUP BY order_id
				) as total', 'total.order_id = orders.order_id', 'left');

				

				$data['orders'] = $this->db->get()->result_array();
				

				$this->load->view('layout/header', $data);
				$this->load->view('layout/navbar', $data);
				$this->load->view('layout/sidebar', $data);
				$this->load->view('admin/order/order_detail', $data);
				$this->load->view('layout/alert');
				$this->load->view('layout/footer');
			}
		} else {
			$this->session->set_flashdata('error', 'Gagal mengakses halaman, Order ID tidak ada.');
			redirect("admin/order_list");
		}
	}





}

?>