<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    
	public function __construct()
    {
        parent::__construct();
        is_logged_in();
        check_access(['2']);

        $this->load->helper('time');

		date_default_timezone_set('Asia/Jakarta');

        $this->load->model('User_model');
        $this->load->model('Order_model');
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

    public function order_settings_cnc()
	{
		$user_id = $this->session->userdata('user_id');
		$data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();
		$data['title'] = 'Admin Order Settings Cnc';
        
		$data['cnc_material'] = $this->db->get('cnc_material')->result_array();
		$data['cnc_finishing'] = $this->db->get('cnc_finishing')->result_array();

		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
        $this->load->view('layout/sidebar', $data);
		$this->load->view('admin/order/order_settings_cnc', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
	}

	public function tambah_cnc_material()
    {
        $redirect = $this->input->server('HTTP_REFERER') ?? base_url('default-url');


        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('nama', 'nama', 'required|trim', [
                'required' => '%s wajib diisi.'
            ]);

                if ($this->form_validation->run() === FALSE) {
                    $this->session->set_flashdata('old', [
                        'nama'        => set_value('nama'),
                    ]);
                    $this->session->set_flashdata('errors', [
                        'nama'        => form_error('nama'),
                    ]);
                    redirect($redirect);
                } else {
                    $nama = $this->input->post('nama', TRUE);
					$this->Order_model->insert_cnc_material(['nama' => $nama]);
					$this->session->set_flashdata('success', 'CNC Material berhasil ditambah.');
                }

            redirect($redirect);
        } else {
            $this->session->set_flashdata('error', 'CNC Material gagal ditambah.');
            redirect($redirect);
        }
    }

	public function edit_cnc_material()
    {
        $redirect = $this->input->server('HTTP_REFERER') ?? base_url('default-url');


        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('nama', 'nama', 'required|trim', [
                'required' => '%s wajib diisi.'
            ]);

			$encrypted_material_id = $this->input->post('material_id');
            $material_id = decrypt_id($encrypted_material_id);

            if (empty($material_id)) {
                $this->session->set_flashdata('error', 'Gagal mengakses halaman, CNC Material ID tidak ada.');
                redirect($redirect);
            }

            $material = $this->db->get_where('cnc_material', ['id' => $material_id])->row_array();
            if (!$material) {
                $this->session->set_flashdata('error', 'Data CNC Material tidak ditemukan.');
                redirect($redirect);
            }

            if ($this->form_validation->run() === FALSE) {
                $this->session->set_flashdata('old', [
                    'nama'        => set_value('nama'),
                ]);
                $this->session->set_flashdata('errors', [
                    'nama'        => form_error('nama'),
                ]);
                redirect($redirect);
            } else {
                $nama = $this->input->post('nama', TRUE);
				$this->Order_model->edit_cnc_material($material_id, ['nama' => $nama]);
				$this->session->set_flashdata('success', 'CNC Material berhasil diubah.');
            }

            redirect($redirect);
        } else {
            $this->session->set_flashdata('error', 'CNC Material gagal diubah.');
            redirect($redirect);
        }
    }

	

	public function delete_cnc_material()
    {
        $redirect = $this->input->server('HTTP_REFERER') ?? base_url('default-url');


        if ($this->input->method() === 'post') {

			$encrypted_material_id = $this->input->post('material_id');
            $material_id = decrypt_id($encrypted_material_id);

            if (empty($material_id)) {
                $this->session->set_flashdata('error', 'Gagal mengakses halaman, CNC Material ID tidak ada.');
                redirect($redirect);
            }

            $material = $this->db->get_where('cnc_material', ['id' => $material_id])->row_array();
            if (!$material) {
                $this->session->set_flashdata('error', 'Data CNC Material tidak ditemukan.');
                redirect($redirect);
            }

			$this->Order_model->delete_cnc_material($material_id);
			$this->session->set_flashdata('success', 'CNC Material berhasil dihapus.');
            redirect($redirect);
        } else {
            $this->session->set_flashdata('error', 'CNC Material gagal dihapus.');
            redirect($redirect);
        }
    }

	public function tambah_cnc_finishing()
    {
        $redirect = $this->input->server('HTTP_REFERER') ?? base_url('default-url');


        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('nama', 'nama', 'required|trim', [
                'required' => '%s wajib diisi.'
            ]);

                if ($this->form_validation->run() === FALSE) {
                    $this->session->set_flashdata('old', [
                        'nama'        => set_value('nama'),
                    ]);
                    $this->session->set_flashdata('errors', [
                        'nama'        => form_error('nama'),
                    ]);
                    redirect($redirect);
                } else {
                    $nama = $this->input->post('nama', TRUE);
					$this->Order_model->insert_cnc_finishing(['nama' => $nama]);
					$this->session->set_flashdata('success', 'CNC Finishing berhasil ditambah.');
                }

            redirect($redirect);
        } else {
            $this->session->set_flashdata('error', 'CNC Finishing gagal ditambah.');
            redirect($redirect);
        }
    }

	public function edit_cnc_finishing()
    {
        $redirect = $this->input->server('HTTP_REFERER') ?? base_url('default-url');


        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('nama', 'nama', 'required|trim', [
                'required' => '%s wajib diisi.'
            ]);

			$encrypted_finishing_id = $this->input->post('finishing_id');
            $finishing_id = decrypt_id($encrypted_finishing_id);

            if (empty($finishing_id)) {
                $this->session->set_flashdata('error', 'Gagal mengakses halaman, CNC Finishing ID tidak ada.');
                redirect($redirect);
            }

            $finishing = $this->db->get_where('cnc_finishing', ['id' => $finishing_id])->row_array();
            if (!$finishing) {
                $this->session->set_flashdata('error', 'Data CNC Finishing tidak ditemukan.');
                redirect($redirect);
            }

            if ($this->form_validation->run() === FALSE) {
                $this->session->set_flashdata('old', [
                    'nama'        => set_value('nama'),
                ]);
                $this->session->set_flashdata('errors', [
                    'nama'        => form_error('nama'),
                ]);
                redirect($redirect);
            } else {
                $nama = $this->input->post('nama', TRUE);
				$this->Order_model->edit_cnc_finishing($finishing_id, ['nama' => $nama]);
				$this->session->set_flashdata('success', 'CNC inishing berhasil diubah.');
            }

            redirect($redirect);
        } else {
            $this->session->set_flashdata('error', 'CNC Finishing gagal diubah.');
            redirect($redirect);
        }
    }

	

	public function delete_cnc_finishing()
    {
        $redirect = $this->input->server('HTTP_REFERER') ?? base_url('default-url');


        if ($this->input->method() === 'post') {

			$encrypted_finishing_id = $this->input->post('finishing_id');
            $finishing_id = decrypt_id($encrypted_finishing_id);

            if (empty($finishing_id)) {
                $this->session->set_flashdata('error', 'Gagal mengakses halaman, CNC Finishing ID tidak ada.');
                redirect($redirect);
            }

            $finishing = $this->db->get_where('cnc_finishing', ['id' => $finishing_id])->row_array();
            if (!$finishing) {
                $this->session->set_flashdata('error', 'Data CNC Finishing tidak ditemukan.');
                redirect($redirect);
            }

			$this->Order_model->delete_cnc_finishing($finishing_id);
			$this->session->set_flashdata('success', 'CNC Finishing berhasil dihapus.');
            redirect($redirect);
        } else {
            $this->session->set_flashdata('error', 'CNC Finishing gagal dihapus.');
            redirect($redirect);
        }
    }

	


    public function order_management()
	{
		$user_id = $this->session->userdata('user_id');
		$data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();
		$data['title'] = 'Order Management Page';
		

		$this->db->select('orders.*, user.nama, user.email, user.foto');
		$this->db->from('orders');
		$this->db->join('user', 'user.id = orders.user_id', 'left');
		$this->db->order_by('orders.date_created', 'DESC');
		$data['orders'] = $this->db->get()->result_array();

		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('admin/order/order_management', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
	}


	public function delete_order()
	{
		$redirect = $this->input->server('HTTP_REFERER') ?? base_url('admin/order_list');

		$bulkIdsJson = $this->input->post('delete_order_ids_bulk');
		$singleId    = $this->input->post('order_id');

		if ($bulkIdsJson) {
			$encrypted_ids = json_decode($bulkIdsJson, true);

			if (is_array($encrypted_ids)) {
				$order_ids = [];
				foreach ($encrypted_ids as $encrypted_id) {
					$decrypted_id = decrypt_id($encrypted_id);
					if (!empty($decrypted_id)) {
						$order_ids[] = $decrypted_id;
					}
				}

				foreach ($order_ids as $id) {
					$this->Order_model->delete_order_with_items($id);
				}
				$this->session->set_flashdata('success', count($order_ids) . " order berhasil dihapus.");
				redirect($redirect);
			} else {
				$this->session->set_flashdata('error', "Format data tidak valid.");
				redirect($redirect);
			}
		} elseif ($singleId) {
			$decrypted_id = decrypt_id($singleId);
			if (!empty($decrypted_id)) {
				$this->Order_model->delete_order_with_items($decrypted_id);
				$this->session->set_flashdata('success', "Order berhasil dihapus.");
				redirect($redirect);
			} else {
				$this->session->set_flashdata('error', "Order ID tidak valid.");
				redirect($redirect);
			}
		} else {
			$this->session->set_flashdata('error', "Tidak ada ID order yang dikirim.");
			redirect($redirect);
		}

	}


	public function ubah_status_order()
	{
		$redirect = $this->input->server('HTTP_REFERER') ?? base_url('admin/order_list');

		$bulkIdsJson   = $this->input->post('ubahStatus_order_ids_bulk');
		$singleId      = $this->input->post('order_id');
		$paymentStatus = $this->input->post('payment_status');
		$orderStatus   = $this->input->post('order_status');

		if ($bulkIdsJson) {
			$encrypted_ids = json_decode($bulkIdsJson, true);

			if (is_array($encrypted_ids)) {
				$order_ids = [];
				foreach ($encrypted_ids as $encrypted_id) {
					$decrypted_id = decrypt_id($encrypted_id);
					if (!empty($decrypted_id)) {
						$order_ids[] = $decrypted_id;
					}
				}

				$this->Order_model->updateOrderStatuses($order_ids, $paymentStatus, $orderStatus);
				$this->session->set_flashdata('success', count($order_ids) . " order berhasil diupdate statusnya.");
				redirect($redirect);
			} else {
				$this->session->set_flashdata('error', "Format data tidak valid.");
				redirect($redirect);
			}
		} elseif ($singleId) {
			$decrypted_id = decrypt_id($singleId);
			if (!empty($decrypted_id)) {
				$this->Order_model->updateOrderStatuses([$decrypted_id], $paymentStatus, $orderStatus);
				$this->session->set_flashdata('success', "Status order berhasil diperbarui.");
				redirect($redirect);
			} else {
				$this->session->set_flashdata('error', "Order ID tidak valid.");
				redirect($redirect);
			}
		} else {
			$this->session->set_flashdata('error', "Tidak ada ID order yang dikirim.");
			redirect($redirect);
		}

		redirect($redirect);
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

		$limit = 10;
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
		$data['selected_payment_status'] = $payment_status;
		$data['selected_order_status'] = $order_status;
		$data['search_keyword'] = $keyword;
		$data['dari'] = $dari;
		$data['sampai'] = $sampai;

		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('admin/order/order_list', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
	}

	public function order_list_today()
	{
		$user_id = $this->session->userdata('user_id');
		$data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();
		$data['title'] = 'Order List Page';

		$payment_status = $this->input->post('payment_status');
		$order_status = $this->input->post('order_status');
		$keyword = $this->input->post('q');

		$dari = date('Y-m-d');
		$sampai = date('Y-m-d');

		$page = (int) $this->input->get('page');
		$page = $page < 1 ? 1 : $page;

		$limit = 10;
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
		$this->db->where("DATE(orders.date_created) BETWEEN '$dari' AND '$sampai'");
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
		$data['selected_payment_status'] = $payment_status;
		$data['selected_order_status'] = $order_status;
		$data['search_keyword'] = $keyword;

		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('admin/order/order_list_today', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
	}




    public function order_detail($encrypted_id = null)
	{
		if (empty($encrypted_id)) {
			$this->session->set_flashdata('error', 'Gagal mengakses halaman, Order ID tidak ada.');
			redirect("admin/order_list");
		}

		$order_id = decrypt_id($encrypted_id);
		if (empty($order_id)) {
			$this->session->set_flashdata('error', 'Gagal mengakses halaman, Order ID tidak ada.');
			redirect("admin/order_list");
		}

		$data['order'] = $this->db->get_where('orders', ['order_id' => $order_id])->row_array();
		if (!$data['order']) {
			$this->session->set_flashdata('error', 'Gagal mengakses halaman, Order ID tidak ada.');
			redirect("admin/order_list");
		}
		
		$data['operator'] = $this->db->get_where('user', ['role_id' => 3])->result_array();
		
		$user_id = $this->session->userdata('user_id');
		$data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();
		$data['title'] = 'Order List Page';

		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('admin/order/order_detail', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
			
	}

	public function tetapkan_operator()
	{
		$redirect = $this->input->server('HTTP_REFERER') ?? base_url('admin/order_list');


		$encrypted_order_id = $this->input->post('order_id');
		$encrypted_operator_id = $this->input->post('operator_id');

		if (empty($encrypted_order_id)) {
			$this->session->set_flashdata('error', 'Gagal mengakses halaman, Order ID tidak ada.');
			redirect($redirect);
		}

		$order_id = decrypt_id($encrypted_order_id);

		if (empty($order_id)) {
			$this->session->set_flashdata('error', 'Gagal mengakses halaman, Order ID tidak ada.');
			redirect($redirect);
		}

		$order = $this->db->get_where('orders', ['order_id' => $order_id, 'payment_status' => 'payment_success'])->row_array();
		if (!$order) {
			$this->session->set_flashdata('error', 'Data Order tidak ditemukan, atau payment status belum sukses.');
			redirect($redirect);
		}

		$operator_id = decrypt_id($encrypted_operator_id);
		if (empty($operator_id)) {
			$this->session->set_flashdata('error', 'Gagal mengakses halaman, Order ID tidak ada.');
			redirect($redirect);
		}
		$operator = $this->db->get_where('user', ['id' => $operator_id, 'role_id' => 3])->row_array();
		if (!$operator) {
			$this->session->set_flashdata('error', 'Operator tidak valid atau bukan role operator.');
			redirect($redirect);
		}


		$admin_id = $this->session->userdata('user_id');
		$this->Order_model->update_orders($order_id, [
			'operator' => $operator_id,
			'admin' => $admin_id,
			'order_status' => 'order_processing',
		]);

		$this->session->set_flashdata('success', 'Operator berhasil ditetapkan.');
		redirect($redirect);
	}






}

?>