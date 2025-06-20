<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customerservice extends CI_Controller {
    
	public function __construct()
    {
        parent::__construct();
        is_logged_in();
        check_access(['4']);

        $this->load->helper('time');

        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function dashboard()
	{
		$user_id = $this->session->userdata('user_id');
		$data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();
		
		$data['errors'] = $this->session->flashdata('errors') ?? [];
		$data['old'] = $this->session->flashdata('old') ?? [];
		
		$data['title'] = 'Customer Service Dashboard';

		$global_chats = $this->db->query("
			SELECT 
				COUNT(chat_id) AS total_chats,
				MAX(date_created) AS last_created,
				TIMESTAMPDIFF(HOUR, MAX(date_created), NOW()) AS hours_since_last_created
			FROM chat
			WHERE receiver_id = $user_id
		")->row_array();

		$data['global_chat_stats'] = $global_chats;

		$recent_chat_users = $this->db
			->select('
				user.id AS user_id,
				user.foto,
				user.nama,
				user.email,
				user.role_id,
				MAX(chat.date_created) AS last_chat_time,
				(
					SELECT message FROM chat 
					WHERE sender_id = user.id AND receiver_id = ' . $user_id . ' 
					ORDER BY date_created DESC 
					LIMIT 1
				) AS last_message,
				(
					SELECT COUNT(*) FROM chat 
					WHERE sender_id = user.id AND receiver_id = ' . $user_id . ' AND is_read = 0
				) AS total_unread_counts
			')
			->from('chat')
			->join('user', 'user.id = chat.sender_id')
			->where('chat.receiver_id', $user_id)
			->group_by('user.id')
			->order_by('last_chat_time', 'DESC')
			->limit(5)
			->get()
			->result_array();
		$data['recent_chat_users'] = $recent_chat_users;

		$this->db->from('orders');
		$this->db->join('user', 'user.id = orders.user_id', 'left');
		$this->db->order_by('orders.date_created', 'DESC');
		$this->db->limit(1);
		$last_order = $this->db->get()->row_array();
		$data['last_order'] = $last_order;

		$settings = $this->db->get_where('settings', ['settings_id' => 7])->row_array();
        $data['background'] = json_decode($settings['item'], true);
        $data['background_dipakai'] = $settings['background_dipakai'];

		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('customerservice/dashboard', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
	}



	public function order_list()
	{
		$user_id = $this->session->userdata('user_id');
		$data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();

		$data['title'] = 'Order List Page';

		$payment_status = $this->input->post('payment_status');
		$order_status = $this->input->post('order_status');
		$keyword = $this->input->post('q');
		$dari = $this->input->post('dari');
		$sampai = $this->input->post('sampai');

		$page = (int) $this->input->get('page');
		$page = $page < 1 ? 1 : $page;
		$limit = 9;
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
		if (!empty($dari) && !empty($sampai) && strtotime($dari) && strtotime($sampai)) {
			$this->db->where("DATE(orders.date_created) BETWEEN '$dari' AND '$sampai'");
		}
		$total_rows = $this->db->count_all_results();

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
		if (!empty($dari) && !empty($sampai) && strtotime($dari) && strtotime($sampai)) {
			$this->db->where("DATE(orders.date_created) BETWEEN '$dari' AND '$sampai'");
		}
		$this->db->order_by('orders.date_created', 'DESC');
		$this->db->limit($limit, $offset);
		$data['orders'] = $this->db->get()->result_array();

		$config['base_url'] = base_url('customerservice/order_list');
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
		$data['dari'] = $dari;
		$data['sampai'] = $sampai;

		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('customerservice/order/order_list', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
	}


	public function order_detail($encrypted_id = null)
	{
		$user_id = $this->session->userdata('user_id');
		$data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();
		
		$data['errors'] = $this->session->flashdata('errors') ?? [];
        $data['old'] = $this->session->flashdata('old') ?? [];

		$data['title'] = 'Order List Page';

		if (empty($encrypted_id)) {
			$this->session->set_flashdata('error', 'Gagal mengakses halaman, Order ID tidak ada.');
			redirect("customerservice/order_list");
		}

		$order_id = decrypt_id($encrypted_id);
		if (empty($order_id)) {
			$this->session->set_flashdata('error', 'Gagal mengakses halaman, Order ID tidak ada.');
			redirect("customerservice/order_list");
		}

		$order = $this->db->get_where('orders', ['order_id' => $order_id])->row_array();
		if (!$order) {
			$this->session->set_flashdata('error', 'Gagal mengakses halaman, Order ID tidak ada.');
			redirect("customerservice/order_list");
		}

		$data['order'] = $order;

		$this->db->where('order_id', $order['order_id']);
		$query = $this->db->get('order_items');
		$order_items = $query->result();
		
		
		$pcb_items = [];
		$cnc_items = [];

		foreach ($order_items as $item) {
			if ($item->product_type === 'pcb') {
				$pcb_items[] = $item;
			} elseif ($item->product_type === 'cnc') {
				$cnc_items[] = $item;
			}
		}

		$data['order_items'] = $order_items;
		$data['pcb_items'] = $pcb_items;
		$data['cnc_items'] = $cnc_items;
		$data['user_info'] = $this->db->get_where('user', ['id' => $order['user_id']])->row_array();
		$shipping_status_list = [];

		if (!empty($order['shipping_status'])) {
			$shipping_status_list = json_decode($order['shipping_status'], true);
			if (!is_array($shipping_status_list)) {
				$shipping_status_list = [];
			}
		}
		$data['shipping_status_list'] = $shipping_status_list;

		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('customerservice/order/order_detail', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
			
	}

}

?>