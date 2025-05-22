<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
    
	public function __construct()
    {
        parent::__construct();
        is_logged_in();
        check_access(['1', '2', '3', '4', '5']);

        $this->load->helper('time');

		require_once APPPATH . '../vendor/autoload.php';

        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function dashboard()
	{
		$user_id = $this->session->userdata('user_id');
		$data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();

		$data['title'] = 'Customer Dashboard';

		$data['errors'] = $this->session->flashdata('errors') ?? [];
		$data['old'] = $this->session->flashdata('old') ?? [];
		
        // --- 1. Payment Status Stats ---
		$payment_statuses = [
			'payment_pending',
			'payment_process',
			'payment_success',
			'payment_cancelled'
		];

		$payment_stats = [];
		foreach ($payment_statuses as $status) {
			$row = $this->db->query("
				SELECT 
					COUNT(order_id) AS total_orders,
					MAX(date_created) AS last_created,
					TIMESTAMPDIFF(HOUR, MAX(date_created), NOW()) AS hours_since_last_created
				FROM orders
				WHERE payment_status = ?
				AND user_id = ?
			", [$status, $user_id])->row_array();

			$payment_stats[$status] = $row;
		}

		$data['payment_stats'] = $payment_stats;

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
				AND user_id = ?
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
			WHERE user_id = ?
		", [$user_id])->row_array();

		$data['global_order_stats'] = $global_orders;

		// --- Recent Order Users ---
		$recent_order_users = $this->db
			->select('user.foto, user.nama, user.email, orders.date_created AS order_date')
			->from('orders')
			->join('user', 'user.id = orders.user_id', 'left')
			->where('orders.user_id', $user_id)
			->order_by('orders.date_created', 'DESC')
			->limit(5)
			->get()
			->result_array();

		$data['recent_order_users'] = $recent_order_users;

		// --- 4. Last Order ---
		$this->db->from('orders');
		$this->db->join('user', 'user.id = orders.user_id', 'left');
		$this->db->where('orders.user_id', $user_id);
		$this->db->order_by('orders.date_created', 'DESC');
		$this->db->limit(1);
		$last_order = $this->db->get()->row_array();

		$data['last_order'] = $last_order;

		$shipping_status_list = [];

		if (!empty($last_order['shipping_status'])) {
			$shipping_status_list = json_decode($last_order['shipping_status'], true);
			if (!is_array($shipping_status_list)) {
				$shipping_status_list = [];
			}
		}
		$data['shipping_status_list'] = $shipping_status_list;

		// --- Load Views ---
		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('customer/dashboard', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
	}


	public function history()
    {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();
        $data['title'] = 'Order List Page';

        $payment_status = $this->input->post('payment_status');
        $order_status = $this->input->post('order_status');

        $dari = $this->input->post('dari');
        $sampai = $this->input->post('sampai');

        $page = (int) $this->input->get('page');
        $page = $page < 1 ? 1 : $page;

        $limit = 9;
        $offset = ($page - 1) * $limit;

        $this->db->from('orders');
        $this->db->join('user', 'user.id = orders.user_id', 'left');
        $this->db->where('orders.user_id', $user_id);
        if (!empty($payment_status)) {
            $this->db->where('orders.payment_status', $payment_status);
        }
        if (!empty($order_status)) {
            $this->db->where('orders.order_status', $order_status);
        }
        if (!empty($dari) && !empty($sampai) && strtotime($dari) && strtotime($sampai)) {
            $this->db->where("DATE(orders.date_created) BETWEEN '$dari' AND '$sampai'");
        }

        $total_rows = $this->db->count_all_results();

        $this->db->select('orders.*, user.nama, user.email, user.foto');
        $this->db->from('orders');
        $this->db->join('user', 'user.id = orders.user_id', 'left');
        $this->db->where('orders.user_id', $user_id);
        if (!empty($payment_status)) {
            $this->db->where('orders.payment_status', $payment_status);
        }
        if (!empty($order_status)) {
            $this->db->where('orders.order_status', $order_status);
        }
        if (!empty($dari) && !empty($sampai) && strtotime($dari) && strtotime($sampai)) {
            $this->db->where("DATE(orders.date_created) BETWEEN '$dari' AND '$sampai'");
        }
        $this->db->order_by('orders.date_created', 'DESC');
        $this->db->limit($limit, $offset);
        $data['orders'] = $this->db->get()->result_array();

        $config['base_url'] = base_url('customer/history');
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
        $data['dari'] = $dari;
        $data['sampai'] = $sampai;

        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('customer/order/history', $data);
        $this->load->view('layout/alert');
        $this->load->view('layout/footer');
    }


    public function order_detail($encrypted_id = null)
	{
		if (empty($encrypted_id)) {
			$this->session->set_flashdata('error', 'Gagal mengakses halaman, Order ID tidak ada.');
			redirect("customer/history");
		}

		$order_id = decrypt_id($encrypted_id);
		if (empty($order_id)) {
			$this->session->set_flashdata('error', 'Gagal mengakses halaman, Order ID tidak ada.');
			redirect("customer/history");
		}

		$order = $this->db->get_where('orders', ['order_id' => $order_id])->row_array();
		if (!$order) {
			$this->session->set_flashdata('error', 'Gagal mengakses halaman, Order ID tidak ada.');
			redirect("customer/history");
		}

        $user_info = $this->db->get_where('user', ['id' => $order['user_id']])->row_array();
		$user_id = $this->session->userdata('user_id');

		if (!$user_info) {
			$this->session->set_flashdata('error', 'Gagal mengunduh PDF, data user tidak ditemukan.');
			redirect("customer/history");
		}
		if ($order['user_id'] != $user_id) {
			$this->session->set_flashdata('error', 'Anda tidak memiliki izin untuk mengakses order ini.');
			redirect("customer/history");
		}

		$data['order'] = $order;

		$this->db->where('order_id', $order['order_id']);
		$query = $this->db->get('order_items');
		$order_items = $query->result();
		
		
		$pcb_items = [];
		$cnc_items = [];

		// Pisahkan berdasarkan product_type
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
		$data['operator'] = $this->db->get_where('user', ['role_id' => 3])->result_array();

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
		$data['title'] = 'Order List Page';

		$data['errors'] = $this->session->flashdata('errors') ?? [];
        $data['old'] = $this->session->flashdata('old') ?? [];

		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('customer/order/order_detail', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
			
	}

	public function approve_order()
    {
        $redirect = $this->input->server('HTTP_REFERER') ?? base_url('default-url');


        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('order_id', 'order_id', 'required|trim', [
                'required' => '%s wajib diisi.'
            ]);
            $this->form_validation->set_rules('approved_price', 'approved_price', 'required|trim', [
                'required' => '%s wajib diisi.'
            ]);
            $this->form_validation->set_rules('payment_method', 'payment_method', 'required|trim', [
                'required' => '%s wajib pilih salah satu.'
            ]);

                if ($this->form_validation->run() === FALSE) {
                    $this->session->set_flashdata('old', [
                        'approved_price'        => set_value('approved_price'),
                        'payment_method'        => set_value('payment_method'),
                    ]);
                    $this->session->set_flashdata('errors', [
                        'approved_price'        => form_error('approved_price'),
                        'payment_method'        => form_error('payment_method'),
                    ]);
					redirect($redirect);
                } else {
					$approved_price = $this->input->post('approved_price') ? 1 : 0;
                    $payment_method = $this->input->post('payment_method');
					$order_id = decrypt_id($this->input->post('order_id'));
					if (empty($order_id)) {
						$this->session->set_flashdata('error', 'Gagal mengakses halaman, Order ID tidak ada.');
						redirect($redirect);
					}

					$order = $this->db->get_where('orders', ['order_id' => $order_id])->row_array();
					if (!$order) {
						$this->session->set_flashdata('error', 'Gagal mengakses halaman, Order ID tidak ada.');
						redirect("customer/history");
					}

					if ($payment_method == 'midtrans') {
						$midtrans_server_key = $this->db->get_where('settings', ['settings_id' => '6'])->row_array();
						$shipping_info = json_decode($order['shipping_info'], true);
						$clean_total_price = $order['total_price'];

						\Midtrans\Config::$serverKey = $midtrans_server_key['item'];
						\Midtrans\Config::$isProduction = false;
						\Midtrans\Config::$isSanitized = true;
						\Midtrans\Config::$is3ds = true;

						$params = [
							'transaction_details' => [
								'order_id' => $order['order_code'],
								'date' => $order['date_created'],
								'gross_amount' => $clean_total_price,
							],
							'customer_details' => [
								'first_name'    => $shipping_info['nama'],
								'phone'         => $shipping_info['nomor'],
							],
						];

						$snapToken = \Midtrans\Snap::getSnapToken($params);

						$data = [
							'snap_token' => $snapToken,
							'approved_price' => $approved_price,
							'payment_method' => $payment_method,
						];
					} elseif ($payment_method == 'tokopedia') {
						$data = [
							'approved_price' => $approved_price,
							'payment_method' => $payment_method,
						];
					}


					$this->db->where('order_id', $order_id);
					$this->db->update('orders', $data);
					$this->session->set_flashdata('success', 'Berhasil memilih payment method.');
                }

            redirect($redirect);
        } else {
            $this->session->set_flashdata('error', 'Err.');
            redirect($redirect);
        }
    }
}

?>