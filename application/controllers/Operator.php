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

		$data['errors'] = $this->session->flashdata('errors') ?? [];
		$data['old'] = $this->session->flashdata('old') ?? [];
		

		// --- 2. Order Status Stats ---
		$order_statuses = [
			'order_pending',
			'order_confirmed',
			'order_processing',
			'order_completed',
			'order_cancelled',
			'order_refunded',
			'order_failed'
		];

		$order_stats = [];
		foreach ($order_statuses as $status) {
			$row = $this->db->query("
				SELECT 
					COUNT(order_id) AS total_orders,
					MAX(date_created) AS last_created,
					TIMESTAMPDIFF(HOUR, MAX(date_created), NOW()) AS hours_since_last_created
				FROM orders
				WHERE order_status = ?
				AND operator = ?
			", [$status, $user_id])->row_array();

			$order_stats[$status] = $row;
		}

		$data['order_stats'] = $order_stats;

		// --- 3. Global Order Stats ---
		$global_orders = $this->db->query("
			SELECT 
				COUNT(order_id) AS total_orders,
				MAX(date_created) AS last_created,
				TIMESTAMPDIFF(HOUR, MAX(date_created), NOW()) AS hours_since_last_created
			FROM orders
			WHERE operator = ?
		", [$user_id])->row_array();

		$data['global_order_stats'] = $global_orders;

		// --- Recent Order Users ---
		$recent_order_users = $this->db
			->select('user.foto, user.nama, user.email, orders.date_created AS order_date')
			->from('orders')
			->join('user', 'user.id = orders.user_id', 'left')
			->where('orders.operator', $user_id)
			->order_by('orders.date_created', 'DESC')
			->limit(5)
			->get()
			->result_array();

		$data['recent_order_users'] = $recent_order_users;

		// --- 4. Last Order ---
		$this->db->from('orders');
		$this->db->join('user', 'user.id = orders.user_id', 'left');
		$this->db->where('orders.operator', $user_id);
		$this->db->order_by('orders.date_created', 'DESC');
		$this->db->limit(1);
		$last_order = $this->db->get()->row_array();

		$data['last_order'] = $last_order;

		$settings = $this->db->get_where('settings', ['settings_id' => 7])->row_array();
        $data['background'] = json_decode($settings['item'], true);
        $data['background_dipakai'] = $settings['background_dipakai'];
		// --- Load Views ---
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
		$this->db->where('orders.operator', $user_id);
		
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
		$this->db->where('orders.operator', $user_id);
		
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
		$data['selected_order_status'] = $order_status;
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

		$limit = 9;
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

		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('operator/order/order_list_today', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
	}


	public function order_detail($encrypted_id = null)
	{
		if (empty($encrypted_id)) {
			$this->session->set_flashdata('error', 'Gagal mengakses halaman, Order ID tidak ada.');
			redirect("operator/order_list");
		}

		$order_id = decrypt_id($encrypted_id);
		if (empty($order_id)) {
			$this->session->set_flashdata('error', 'Gagal mengakses halaman, Order ID tidak ada.');
			redirect("operator/order_list");
		}

		$order = $this->db->get_where('orders', ['order_id' => $order_id])->row_array();
		if (!$order) {
			$this->session->set_flashdata('error', 'Gagal mengakses halaman, Order ID tidak ada.');
			redirect("operator/order_list");
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
		$data['shipping_status'] = $this->db->get('shipping_status')->result_array();

		$shipping_status_list = [];

		if (!empty($order['shipping_status'])) {
			$shipping_status_list = json_decode($order['shipping_status'], true);
			if (!is_array($shipping_status_list)) {
				$shipping_status_list = [];
			}
		}
		$data['shipping_status_list'] = $shipping_status_list;
		
		$user_id = $this->session->userdata('user_id');
		$data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();
		$data['title'] = 'Order Detail Page';

		$data['errors'] = $this->session->flashdata('errors') ?? [];
        $data['old'] = $this->session->flashdata('old') ?? [];

		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('operator/order/order_detail', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
			
	}


	public function ubah_shipping_status()
	{
		$redirect = $this->input->server('HTTP_REFERER') ?? base_url('default-url');

		if ($this->input->method() === 'post') {
			$this->form_validation->set_rules('shipping_status', 'Shipping Status', 'required|numeric|trim', [
				'required' => '%s wajib diisi.',
				'numeric'  => 'Error, Shipping Status tidak terbaca.',
			]);

			$encrypted_order_id = $this->input->post('order_id');
			$order_id = decrypt_id($encrypted_order_id);
			if (empty($order_id)) {
				$this->session->set_flashdata('error', 'Gagal mengakses halaman, Order ID tidak ada.');
				redirect($redirect);
			}

			$order = $this->db->get_where('orders', ['order_id' => $order_id])->row_array();
			if (!$order) {
				$this->session->set_flashdata('error', 'Data Order tidak ditemukan.');
				redirect($redirect);
			}

			if ($this->form_validation->run() === FALSE) {
				$this->session->set_flashdata('old', [
					'shipping_status' => set_value('shipping_status'),
				]);
				$this->session->set_flashdata('errors', [
					'shipping_status' => form_error('shipping_status'),
				]);
				redirect($redirect);
			} else {
				$shipping_status = $this->input->post('shipping_status', TRUE);

				$old_status_json = $order['shipping_status'];
				$status_list = [];

				if (!empty($old_status_json)) {
					$status_list = json_decode($old_status_json, true);
					if (!is_array($status_list)) {
						$status_list = [];
					}
				}

				$new_no = count($status_list) + 1;

				$status_list[] = [
					'no'           => $new_no,
					'shipping_id' => (int)$shipping_status,
					'date'        => date('Y-m-d H:i:s'),
				];

				$update_data = [
					'shipping_status' => json_encode($status_list),
				];
				$this->db->where('order_id', $order_id)->update('orders', $update_data);

				$this->session->set_flashdata('success', 'Shipping Status berhasil diubah.');
				redirect($redirect);
			}
		} else {
			$this->session->set_flashdata('error', 'Shipping Status gagal diubah.');
			redirect($redirect);
		}
	}

	public function hapus_shipping_status()
	{
		$redirect = $this->input->server('HTTP_REFERER') ?? base_url('default-url');

		if ($this->input->method() === 'post') {
			$encrypted_order_id = $this->input->post('order_id');
			$shipping_no = $this->input->post('shipping_no');

			$order_id = decrypt_id($encrypted_order_id);
			if (empty($order_id)) {
				$this->session->set_flashdata('error', 'Gagal mengakses halaman, Order ID tidak valid.');
				redirect($redirect);
			}

			$order = $this->db->get_where('orders', ['order_id' => $order_id])->row_array();
			if (!$order) {
				$this->session->set_flashdata('error', 'Data order tidak ditemukan.');
				redirect($redirect);
			}

			$shipping_status_json = $order['shipping_status'];
			$shipping_status_data = json_decode($shipping_status_json, true);

			if (!is_array($shipping_status_data)) {
				$shipping_status_data = [];
			}

			$shipping_status_data = array_filter($shipping_status_data, function($item) use ($shipping_no) {
				return $item['no'] != $shipping_no;
			});

			$shipping_status_data = array_values($shipping_status_data);
			$new_shipping_status_json = json_encode($shipping_status_data);

			$this->db->where('order_id', $order_id)->update('orders', [
				'shipping_status' => $new_shipping_status_json
			]);

			$this->session->set_flashdata('success', 'Shipping status berhasil dihapus.');
			redirect($redirect);
		} else {
			$this->session->set_flashdata('error', 'Gagal menghapus shipping status.');
			redirect($redirect);
		}
	}


}

?>