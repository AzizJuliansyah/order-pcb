<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;

class Index extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

		require_once FCPATH . 'vendor/autoload.php';

		$this->load->model('User_model');
		$this->load->model('Order_model');
		$this->load->library('form_validation');
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
		
		$this->db->limit(16);
		$this->db->order_by('blog_id', 'DESC');
		$data['blogs'] = $this->db->get_where('blog', ['status' => 'approved'])->result_array();
		
		$data['carousel_images'] = $this->db->get('carousel_images')->result();

		$data['has_sidebar'] = false;
		$this->load->view('index/landingpage', $data);
		$this->load->view('layout/alert');
	}



    public function order()
	{
		is_logged_in();

		if ($this->session->userdata('user_id')) {
			$user_id = $this->session->userdata('user_id');

			$user = $this->db->get_where('user', ['id' => $user_id])->row_array();
			$data['user'] = $user;
			$data['role_id'] = $user['role_id'];
		}

		$data['errors'] = $this->session->flashdata('errors') ?? [];
        $data['old'] = $this->session->flashdata('old') ?? [];

		$data['title'] = 'Order';

		$data['cnc_material'] = $this->db->get('cnc_material')->result_array();
		$data['cnc_finishing'] = $this->db->get('cnc_finishing')->result_array();

		$this->db->where('user_id', $user_id);
		$query = $this->db->get('cart');
		$data['carts'] = $query->result();
		$data['cart_item_count'] = $query->num_rows();

		$data['has_sidebar'] = false;
		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('index/order/order', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
	}

	public function order_pcb_form()
	{
		is_logged_in();
		
		$redirect = base_url('order?pcb') ?? base_url('order');
		$user_id = $this->session->userdata('user_id');

		if (empty($user_id)) {
            $this->session->set_flashdata('error', 'Gagal mengakses halaman, user ID tidak ada.');
            redirect($redirect);
        }

		if ($this->input->method() === 'post') {
			$this->form_validation->set_rules('leadfree', 'Lead Free', 'trim');
			$this->form_validation->set_rules('functionaltest', 'Functional Test', 'trim');
			$this->form_validation->set_rules('note', 'Note', 'required|min_length[1]|trim', [
                'required'    => '%s wajib diisi.',
                'min_length'  => '%s minimal 1 karakter.'
            ]);
			$this->form_validation->set_rules('quantity', 'Quantity', 'required|numeric|trim', [
                'required'     => '%s wajib diisi.',
                'numeric'      => '%s harus berupa angka.',
            ]);
			$this->form_validation->set_rules('leadtime', 'Lead Time', 'required|numeric|trim', [
                'required'     => '%s wajib diisi.',
                'numeric'      => '%s harus berupa angka.',
            ]);

			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('errors', [
                    'gerberfile'          => form_error('gerberfile'),
                    'bomfile'        	  => form_error('bomfile'),
                    'pickandplacefile'    => form_error('pickandplacefile'),

                    'note'        		  => form_error('note'),
                    'quantity'    		  => form_error('quantity'),
                    'leadtime'    		  => form_error('leadtime'),
                ]);            
				$this->session->set_flashdata('old', [
                    'leadfree'            => set_value('leadfree'),
                    'functionaltest'      => set_value('functionaltest'),

                    'note'        		  => set_value('note'),
                    'quantity'            => set_value('quantity'),
                    'leadtime'       	  => set_value('leadtime'),
                ]);
				redirect($redirect);
			} else {
				$leadfree = $this->input->post('leadfree') ? 1 : 0;
				$functionaltest = $this->input->post('functionaltest') ? 1 : 0;
				$file_fields = [
					'gerberfile' => ['path' => './public/web_assets/pcb_file/gerberfile/', 'allowed' => 'zip|rar', 'max_size' => 20480],
					'bomfile' => ['path' => './public/web_assets/pcb_file/bomfile/', 'allowed' => 'txt|csv', 'max_size' => 2048],
					'pickandplacefile' => ['path' => './public/web_assets/pcb_file/pickandplacefile/', 'allowed' => 'txt|csv', 'max_size' => 2048]
				];

				$this->load->library('upload');
				$errors = [];
				$uploaded_files = [];

				foreach ($file_fields as $field => $config_data) {
					if (empty($_FILES[$field]['name'])) {
						$errors[$field] = ucfirst($field) . " wajib diunggah.";
						continue;
					}

					$ext = strtolower(pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION));
					$allowed_ext = explode('|', $config_data['allowed']);
					if (!in_array($ext, $allowed_ext)) {
						$errors[$field] = ucfirst($field) . " harus berupa file: " . implode(', ', $allowed_ext) . ".";
						continue;
					}

					$config['upload_path']   = $config_data['path'];
					// $config['allowed_types'] = $config_data['allowed'];
					$config['allowed_types'] = '*';
					$config['max_size']      = $config_data['max_size'];
					$config['file_name']     = $field . '_' . $user_id . '_' . uniqid() . '_' . time();
					$config['detect_mime']   = FALSE;

					$this->upload->initialize($config);

					if ($this->upload->do_upload($field)) {
						$uploadData = $this->upload->data();
						$uploaded_files[$field] = 'web_assets/pcb_file/' . $field . '/' . $uploadData['file_name'];
					} else {
						$errors[$field] = strip_tags($this->upload->display_errors());
					}
				}

				if (!empty($errors)) {
					foreach ($uploaded_files as $uploaded_file) {
						if (file_exists('./public/' . $uploaded_file)) {
							unlink('./public/' . $uploaded_file); 
						}
					}
					
					$this->session->set_flashdata('errors', $errors);
					$this->session->set_flashdata('old', [
						'leadfree'       => set_value('leadfree'),
						'functionaltest' => set_value('functionaltest'),
						'note'           => set_value('note'),
						'quantity'       => set_value('quantity'),
						'leadtime'       => set_value('leadtime'),
					]);
					redirect($redirect);
				}

				$product_info = [
					'gerberfile'       => isset($uploaded_files['gerberfile']) ? $uploaded_files['gerberfile'] : null,
					'bomfile'          => isset($uploaded_files['bomfile']) ? $uploaded_files['bomfile'] : null,
					'pickandplacefile' => isset($uploaded_files['pickandplacefile']) ? $uploaded_files['pickandplacefile'] : null,
					'leadfree'         => $leadfree,
					'functionaltest'   => $functionaltest,
					'note'             => $this->input->post('note'),
					'quantity'         => (int)$this->input->post('quantity'),
					'leadtime'         => (int)$this->input->post('leadtime'),
				];

				$insert_data = [
					'user_id'        => $user_id,
					'product_type'   => 'pcb',
					'product_info'   => json_encode($product_info),
				];

				$this->Order_model->insert_to_cart($insert_data);

				$this->session->set_flashdata('success', 'Order berhasil dimasukkan ke keranjang.');
				redirect($redirect);

			}
		} else {
            $this->session->set_flashdata('error', 'Gagal');
            redirect($redirect);
        }
	}

	public function order_cnc_form()
	{
		is_logged_in();
		
		$redirect = base_url('order?cnc') ?? base_url('order');
		$user_id = $this->session->userdata('user_id');

		if (empty($user_id)) {
            $this->session->set_flashdata('error', 'Gagal mengakses halaman, user ID tidak ada.');
            redirect($redirect);
        }
		

		if ($this->input->method() === 'post') {
			$this->form_validation->set_rules('material', 'Material', 'required|numeric|trim', [
                'required'     => '%s wajib diisi.',
                'numeric'      => '%s harus berupa angka.',
            ]);
			$this->form_validation->set_rules('finishing', 'Finishing', 'required|numeric|trim', [
                'required'     => '%s wajib diisi.',
                'numeric'      => '%s harus berupa angka.',
            ]);

			$this->form_validation->set_rules('note', 'Note', 'required|min_length[10]|trim', [
                'required'    => '%s wajib diisi.',
                'min_length'  => '%s minimal 10 karakter.'
            ]);
			$this->form_validation->set_rules('quantity', 'Quantity', 'required|numeric|trim', [
                'required'     => '%s wajib diisi.',
                'numeric'      => '%s harus berupa angka.',
            ]);
			$this->form_validation->set_rules('leadtime', 'Lead Time', 'required|numeric|trim', [
                'required'     => '%s wajib diisi.',
                'numeric'      => '%s harus berupa angka.',
            ]);

			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('errors', [
                    'material'        	  => form_error('material'),
                    'finishing'        	  => form_error('finishing'),

                    'note'        		  => form_error('note'),
                    'quantity'    		  => form_error('quantity'),
                    'leadtime'    		  => form_error('leadtime'),
                ]);            
				$this->session->set_flashdata('old', [
                    'material'			  => set_value('material'),
                    'finishing'       	  => set_value('finishing'),

                    'note'        		  => set_value('note'),
                    'quantity'            => set_value('quantity'),
                    'leadtime'       	  => set_value('leadtime'),
                ]);
				redirect($redirect);
			} else {
				$file_fields = [
					'3dfile' => ['path' => './public/web_assets/cnc_file/3dfile/', 'allowed' => 'step|igs', 'max_size' => 20480],
					'2dfile' => ['path' => './public/web_assets/cnc_file/2dfile/', 'allowed' => 'pdf|dwg', 'max_size' => 20480],
				];

				$this->load->library('upload');

				$errors = [];
				$uploaded_files = [];

				foreach ($file_fields as $field => $config_data) {
					if (empty($_FILES[$field]['name'])) {
						$errors[$field] = ucfirst($field) . " wajib diunggah.";
						continue;
					}

					$ext = strtolower(pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION));
					$allowed_ext = explode('|', $config_data['allowed']);
					if (!in_array($ext, $allowed_ext)) {
						$errors[$field] = ucfirst($field) . " harus berupa file: " . implode(', ', $allowed_ext) . ".";
						continue;
					}

					$config['upload_path']   = $config_data['path'];
					// $config['allowed_types'] = $config_data['allowed'];
					$config['allowed_types'] = '*';
					$config['max_size']      = $config_data['max_size'];
					$config['file_name']     = $field . '_' . $user_id . '_' . uniqid() . '_' . time();
					$config['detect_mime']   = FALSE;

					$this->upload->initialize($config);

					if ($this->upload->do_upload($field)) {
						$uploadData = $this->upload->data();
						$uploaded_files[$field] = 'web_assets/cnc_file/' . $field . '/' . $uploadData['file_name'];
					} else {
						$errors[$field] = strip_tags($this->upload->display_errors());
					}
				}

				if (!empty($errors)) {
					foreach ($uploaded_files as $uploaded_file) {
						if (file_exists('./public/' . $uploaded_file)) {
							unlink('./public/' . $uploaded_file); 
						}
						
					}
					
					$this->session->set_flashdata('errors', $errors);
					$this->session->set_flashdata('old', [
						'material'       => set_value('material'),
						'finishing'      => set_value('finishing'),
						'note'           => set_value('note'),
						'quantity'       => set_value('quantity'),
						'leadtime'       => set_value('leadtime'),
					]);
					redirect($redirect);
				}

				$product_info = [
					'3dfile'          => isset($uploaded_files['3dfile']) ? $uploaded_files['3dfile'] : null,
					'2dfile'          => isset($uploaded_files['2dfile']) ? $uploaded_files['2dfile'] : null,
					
					'material'         => (int)$this->input->post('material'),
					'finishing'        => (int)$this->input->post('finishing'),

					'note'             => $this->input->post('note'),
					'quantity'         => (int)$this->input->post('quantity'),
					'leadtime'         => (int)$this->input->post('leadtime'),
				];

				$insert_data = [
					'user_id'        => $user_id,
					'product_type'   => 'cnc',
					'product_info'   => json_encode($product_info),
				];

				$this->Order_model->insert_to_cart($insert_data);

				$this->session->set_flashdata('success', 'Order berhasil dimasukkan ke keranjang.');
				redirect($redirect);

			}
		} else {
            $this->session->set_flashdata('error', 'Gagal');
            redirect($redirect);
        }
	}

	public function delete_cart_item()
	{
		is_logged_in();
		
		$user_id = $this->session->userdata('user_id');
		$redirect = $this->input->server('HTTP_REFERER') ?? base_url('order');
		if (empty($user_id)) {
            $this->session->set_flashdata('error', 'Gagal mengakses halaman, user ID tidak ada.');
            redirect($redirect);
        }

		if ($this->input->method() === 'post') {
			$this->form_validation->set_rules('cart_id', 'cart_id', 'required|trim', [
				'required' => '%s wajib diisi.'
			]);

			if ($this->form_validation->run() === FALSE) {
				$this->session->set_flashdata('old', [
					'cart_id'  => set_value('cart_id'),
				]);
				$this->session->set_flashdata('errors', [
					'cart_id' => form_error('cart_id'),
				]);
				redirect($redirect);
			} else {
				$encrypted_cart_id = $this->input->post('cart_id');
				$cart_id = decrypt_id($encrypted_cart_id);

				if (empty($cart_id)) {
					$this->session->set_flashdata('error', 'Gagal mengakses halaman, Item cart ID tidak ada.');
					redirect($redirect);
				}

				$cart = $this->db->get_where('cart', ['cart_id' => $cart_id])->row_array();
				if (!$cart) {
					$this->session->set_flashdata('error', 'Data cart tidak ditemukan.');
					redirect($redirect);
				}

				if ($cart['product_type'] == 'pcb') {
					$file_fields = ['gerberfile', 'bomfile', 'pickandplacefile'];
				} elseif ($cart['product_type'] == 'cnc') {
					$file_fields = ['3dfile', '2dfile'];
				} else {
					$file_fields = [];
				}
				
				$product_info = json_decode($cart['product_info'], true);
				foreach ($file_fields as $field) {
					if (!empty($product_info[$field])) {
						$clean_path = str_replace('\\', '/', $product_info[$field]);
						$full_path = FCPATH . 'public/' . $clean_path;

						if (file_exists($full_path)) {
							unlink($full_path);
						}
					}
				}

				$this->db->delete('cart', ['cart_id' => $cart_id]);

				$this->session->set_flashdata('success', 'Item cart berhasil dihapus.');
				redirect($redirect);
			}
		} else {
			$this->session->set_flashdata('error', 'Item Gagal dihapus.');
			redirect($redirect);
		}
	}


	public function checkout()
    {
		is_logged_in();
		
		$user_id = $this->session->userdata('user_id');
		$redirect = $this->input->server('HTTP_REFERER') ?? base_url('order');
		if (empty($user_id)) {
            $this->session->set_flashdata('error', 'Gagal mengakses halaman, user ID tidak ada.');
            redirect($redirect);
        }

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('nama', 'Nama Penerima', 'required|trim', [
                'required' => '%s wajib diisi.'
            ]);
            $this->form_validation->set_rules('email', 'Email Penerima', 'required|valid_email|trim', [
                'required' => '%s wajib diisi.',
				'valid_email' => 'Format %s tidak valid.',
            ]);
            $this->form_validation->set_rules('nomor', 'Informasi Kontak', 'required|numeric|min_length[10]|max_length[15]|trim', [
                'required'    => '%s wajib diisi.',
                'numeric'     => '%s harus berupa angka.',
                'min_length'  => '%s minimal 10 digit.',
                'max_length'  => '%s maksimal 15 digit.'
            ]);
            $this->form_validation->set_rules('provinsi', 'Provinsi', 'required|trim', [
                'required' => '%s wajib dipilih.'
            ]);
            $this->form_validation->set_rules('kota', 'Kota/Kabupaten', 'required|trim', [
                'required' => '%s wajib dipilih.'
            ]);
            $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required|trim', [
                'required' => '%s wajib dipilih.'
            ]);
            $this->form_validation->set_rules('kode_pos', 'Kode Pos', 'required|numeric|exact_length[5]|trim', [
                'required'     => '%s wajib diisi.',
                'numeric'      => '%s harus berupa angka.',
                'exact_length' => '%s harus terdiri dari 5 digit.'
            ]);
            $this->form_validation->set_rules('alamat_lengkap', 'Alamat Lengkap', 'required|min_length[10]|trim', [
                'required'    => '%s wajib diisi.',
                'min_length'  => '%s minimal 10 karakter.'
            ]);

            if ($this->form_validation->run() === FALSE) {
				$this->session->set_flashdata('errors', [
                    'nama'            => form_error('nama'),
                    'email'            => form_error('email'),
                    'nomor'           => form_error('nomor'),

                    'provinsi'        => form_error('provinsi'),
                    'kota'            => form_error('kota'),
                    'kecamatan'       => form_error('kecamatan'),
                    'kode_pos'        => form_error('kode_pos'),
                    'alamat_lengkap'  => form_error('alamat_lengkap'),
                ]);            
				$this->session->set_flashdata('old', [
                    'nama'            => set_value('nama'),
                    'email'            => set_value('email'),
                    'nomor'           => set_value('nomor'),

                    'provinsi'        => set_value('provinsi'),
                    'kota'            => set_value('kota'),
                    'kecamatan'       => set_value('kecamatan'),
                    'kode_pos'        => set_value('kode_pos'),
                    'alamat_lengkap'  => set_value('alamat_lengkap'),
                ]);
				$this->session->set_flashdata('error', 'Gagal melakukan order.');  
				redirect($redirect);
			} else {
				$this->db->trans_start();
				$customer_data = [
                    'nama' => $this->input->post('nama', TRUE),
                    'email' => $this->input->post('email', TRUE),
                    'nomor' => $this->input->post('nomor', TRUE),

                    'provinsi' => $this->input->post('provinsi', TRUE),
                    'kota' => $this->input->post('kota', TRUE),
                    'kecamatan' => $this->input->post('kecamatan', TRUE),
                    'kode_pos' => $this->input->post('kode_pos', TRUE),
                    'alamat_lengkap' => $this->input->post('alamat_lengkap', TRUE),
                ];

				do {
					$order_code = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'), 0, 6);
					$this->db->where('order_code', $order_code);
					$exists = $this->db->get('orders')->num_rows();
				} while ($exists > 0);

				$order_data = [
					'user_id'        => $user_id,
					'shipping_info'  => json_encode($customer_data),
					'order_code'     => $order_code,
				];
				$this->db->insert('orders', $order_data);
				$order_id = $this->db->insert_id();

				$this->db->where('user_id', $user_id);
				$cart_items = $this->db->get('cart')->result();

				foreach ($cart_items as $item) {
					$item_data = [
						'order_id'      => $order_id,
						'user_id'       => $user_id,
						'product_type'  => $item->product_type,
						'product_info'  => $item->product_info,
					];
					$this->db->insert('order_items', $item_data);
				}

				$this->db->where('user_id', $user_id);
				$this->db->delete('cart');

				$this->db->trans_complete();

				$this->session->set_flashdata('last_order_code', $order_code);
				$this->session->set_flashdata('success', 'Berhasil melakukan order.');
				redirect('index/checkout_success');
			}
        } else {
			$this->session->set_flashdata('error', 'Gagal melakukan order.');
			redirect($redirect);
		}
    }


	public function checkout_success()
	{
		is_logged_in();
		
		$user_id = $this->session->userdata('user_id');

		$data['title'] = 'Checkout Success';
		
		$last_order_code = $this->session->flashdata('last_order_code');
		if (!$last_order_code) {
			$this->session->set_flashdata('error', 'Akses halaman ini tidak diizinkan.');
			redirect(base_url('order'));
		}

		$order = $this->db->get_where('orders', ['order_code' => $last_order_code])->row_array();
		if (!$order) {
			$this->session->set_flashdata('error', 'Data order tidak ditemukan.');
			redirect(base_url('order'));
		}
		if ($order['user_id'] != $user_id) {
			$this->session->set_flashdata('error', 'Anda tidak memiliki izin untuk mengakses order ini.');
			redirect(base_url('order'));
		}

		$data['order'] = $order;

		$data['has_sidebar'] = false;
		$this->load->view('layout/header', $data);
		$this->load->view('index/order/checkout_success', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
	}





	

	public function order_detail_download_pdf($encrypted_id = null)
	{
		is_logged_in();

		if (empty($encrypted_id)) {
			$this->session->set_flashdata('error', 'Gagal mengunduh PDF, Order ID tidak ada.');
			redirect("admin/order_list");
		}

		$order_id = decrypt_id($encrypted_id);
		if (empty($order_id)) {
			$this->session->set_flashdata('error', 'Gagal mengunduh PDF, Order ID tidak valid.');
			redirect("admin/order_list");
		}

		$order = $this->db->get_where('orders', ['order_id' => $order_id])->row_array();
		if (!$order) {
			$this->session->set_flashdata('error', 'Gagal mengunduh PDF, data order tidak ditemukan.');
			redirect("admin/order_list");
		}
		$order_items = $this->db->get_where('order_items', ['order_id' => $order['order_id']])->result();

		$user_info = $this->db->get_where('user', ['id' => $order['user_id']])->row_array();
		if (!$user_info) {
			$this->session->set_flashdata('error', 'Gagal mengunduh PDF, data user tidak ditemukan.');
			redirect("admin/order_list");
		}

		$pcb_items = [];
		$cnc_items = [];

		foreach ($order_items as $item) {
			if ($item->product_type === 'pcb') {
				$pcb_items[] = $item;
			} elseif ($item->product_type === 'cnc') {
				$cnc_items[] = $item;
			}
		}

		$data['order'] = $order;
		$order_code = $order['order_code'];
		$data['order_items'] = $order_items;
		$data['pcb_items'] = $pcb_items;
		$data['cnc_items'] = $cnc_items;
		$data['user_info'] = $user_info;
		if ($user_info['foto'] != null) {
			$data['profile_img_path'] = base_url('public/' . $user_info['foto']);
		} else {
			$data['profile_img_path'] = base_url('public/' . 'local_assets/images/user_default.png');
		}

		$html = $this->load->view('index/order/order_detail_pdf', $data, true);
		$dompdf = new Dompdf();
		$options = $dompdf->getOptions();
		$options->set('isRemoteEnabled', true);
		$dompdf->setOptions($options);
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$dompdf->stream("order_detail_{$order_code}.pdf", array("Attachment" => 1));
	}


	public function order_detail($encrypted_id = null)
	{
		is_logged_in();

		$user_id = $this->session->userdata('user_id');
		$role_id = $this->session->userdata('role_id');
		
		$data['title'] = 'Order List Page';

		if (empty($encrypted_id)) {
			$this->session->set_flashdata('error', 'Gagal mengakses halaman, Order ID tidak ada.');
			redirect("admin/order_list");
		}

		$order_id = decrypt_id($encrypted_id);
		if (empty($order_id)) {
			$this->session->set_flashdata('error', 'Gagal mengakses halaman, Order ID tidak ada.');
			redirect("admin/order_list");
		}

		$order = $this->db->get_where('orders', ['order_id' => $order_id])->row_array();
		if (!$order) {
			$this->session->set_flashdata('error', 'Gagal mengakses halaman, Order ID tidak ada.');
			redirect("admin/order_list");
		}

		$user_info = $this->db->get_where('user', ['id' => $order['user_id']])->row_array();

		if (!$user_info) {
			$this->session->set_flashdata('error', 'Gagal mengunduh PDF, data user tidak ditemukan.');
			redirect("admin/order_list");
		}
		if ($role_id == 5) {
			if ($order['user_id'] != $user_id) {
				$this->session->set_flashdata('error', 'Anda tidak memiliki izin untuk mengakses order ini.');
				redirect("admin/order_list");
			}
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
		$data['user_info'] = $user_info;
		if ($user_info['foto'] != null) {
			$data['profile_img_path'] = base_url('public/' . $user_info['foto']);
		} else {
			$data['profile_img_path'] = base_url('public/' . 'local_assets/images/user_default.png');
		}
		
		$this->load->view('index/order/order_detail_pdf', $data);
	}
	

	public function index_payment()
	{
		is_logged_in();
		$redirect = $this->input->server('HTTP_REFERER') ?? base_url('order');

		$status = $this->input->get('status'); // dari Snap redirect
		$order_code = $this->input->get('order_id'); // dari Snap redirect

		if (!$order_code || !$status) {
			$this->session->set_flashdata('error', 'Gagal mengakses halaman, Order ID atau Status tidak ada.');
			redirect($redirect);
		}

		$order = $this->db->get_where('orders', ['order_code' => $order_code])->row_array();
		if (!$order) {
			$this->session->set_flashdata('error', 'Gagal mengakses halaman, Order ID tidak ditemukan.');
			redirect($redirect);
		}

		// Konfigurasi Midtrans
		$midtrans_server_key = $this->db->get_where('settings', ['settings_id' => '6'])->row_array();
		\Midtrans\Config::$serverKey = $midtrans_server_key['item'];
		\Midtrans\Config::$isProduction = false;
		\Midtrans\Config::$isSanitized = true;
		\Midtrans\Config::$is3ds = true;

		try {
			$transaction_status = \Midtrans\Transaction::status($order_code);
			$payment_data = [
				'status' => $transaction_status->transaction_status,
				'payment_type' => $transaction_status->payment_type ?? '',
				'fraud_status' => $transaction_status->fraud_status ?? '',
				'payment_time' => $transaction_status->transaction_time ?? '',
				'raw_response' => $transaction_status,
			];

			// Simpan info transaksi (log)
			$this->Order_model->update_orders($order['order_id'], [
				'payment_info' => json_encode($payment_data)
			]);

			// Simpan last order untuk view
			$this->session->set_userdata('last_order_code', $order_code);

			// Handle semua kemungkinan status
			switch ($transaction_status->transaction_status) {
				case 'capture':
				case 'settlement':
					$this->Order_model->update_orders($order['order_id'], [
						'payment_status' => 'payment_success',
						'order_status' => 'order_processing'
					]);
					$this->session->set_flashdata('success', 'Pembayaran berhasil.');
					redirect('index/payment_success');
					break;

				case 'pending':
					$this->Order_model->update_orders($order['order_id'], [
						'payment_status' => 'payment_pending'
					]);
					$this->session->set_flashdata('info', 'Pembayaran sedang diproses.');
					redirect('index/payment_pending');
					break;

				case 'deny':
				case 'cancel':
				case 'expire':
					$this->Order_model->update_orders($order['order_id'], [
						'payment_status' => 'payment_cancelled',
						'order_status' => 'order_failed'
					]);
					$this->session->set_flashdata('error', 'Pembayaran gagal, dibatalkan, atau kadaluarsa.');
					redirect('index/payment_failed');
					break;

				default:
					$this->session->set_flashdata('error', 'Status pembayaran tidak dikenali.');
					redirect('index/payment_failed');
			}
		} catch (Exception $e) {
			log_message('error', 'Midtrans error: ' . $e->getMessage());
			$this->session->set_flashdata('error', 'Terjadi kesalahan saat memeriksa status pembayaran.');
			redirect('index/payment_failed');
		}
	}


	public function midtrans_webhook()
	{
		$json = file_get_contents('php://input');
		$data = json_decode($json);

		if (!$data || empty($data->order_id)) {
			show_error('Invalid request', 400);
		}

		$order = $this->db->get_where('orders', ['order_code' => $data->order_id])->row_array();
		if (!$order) {
			show_error('Order not found', 404);
		}

		$payment_data = [
			'status' => $data->transaction_status,
			'payment_type' => $data->payment_type ?? '',
			'fraud_status' => $data->fraud_status ?? '',
			'payment_time' => date('Y-m-d H:i:s'),
			'raw_response' => $data
		];

		$this->Order_model->update_orders($order['order_id'], [
			'payment_info' => json_encode($payment_data)
		]);

		// Update status sesuai kondisi
		switch ($data->transaction_status) {
			case 'capture':
			case 'settlement':
				$this->Order_model->update_orders($order['order_id'], [
					'payment_status' => 'payment_success',
					'order_status' => 'order_processing'
				]);
				break;

			case 'pending':
				$this->Order_model->update_orders($order['order_id'], [
					'payment_status' => 'payment_pending'
				]);
				break;

			case 'deny':
			case 'cancel':
			case 'expire':
				$this->Order_model->update_orders($order['order_id'], [
					'payment_status' => 'payment_cancelled',
					'order_status' => 'order_failed'
				]);
				break;
		}

		echo 'OK';
	}


	public function payment_success()
	{
		is_logged_in();

		$user_id = $this->session->userdata('user_id');

		$data['title'] = 'Payment success';
		
		$order_code = $this->session->userdata('last_order_code') ?: $this->input->get('order_id');
		if (!$order_code) {
			$this->session->set_flashdata('error', 'Akses halaman ini tidak diizinkan.');
			redirect(base_url('customer/history'));
		}

		$order = $this->db->get_where('orders', ['order_code' => $order_code])->row_array();
		if (!$order) {
			$this->session->set_flashdata('error', 'Data order tidak ditemukan.');
			redirect(base_url('customer/history'));
		}
		if ($order['user_id'] != $user_id) {
			$this->session->set_flashdata('error', 'Anda tidak memiliki izin untuk mengakses order ini.');
			redirect(base_url('customer/history'));
		}
		$data['order'] = $order;

		$data['has_sidebar'] = false;
		$this->session->unset_userdata('last_order_code');
		$this->load->view('layout/header', $data);
		$this->load->view('index/order/payment_success', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
	}

	public function payment_pending()
	{
		is_logged_in();
		
		$user_id = $this->session->userdata('user_id');

		$data['title'] = 'Payment pending';

		$last_order_code = $this->session->userdata('last_order_code') ?: $this->input->get('order_id');
		if (!$last_order_code) {
			$this->session->set_flashdata('error', 'Akses halaman ini tidak diizinkan.');
			redirect(base_url('customer/history'));
		}

		$order = $this->db->get_where('orders', ['order_code' => $last_order_code])->row_array();
		if (!$order) {
			$this->session->set_flashdata('error', 'Data order tidak ditemukan.');
			redirect(base_url('customer/history'));
		}
		if ($order['user_id'] != $user_id) {
			$this->session->set_flashdata('error', 'Anda tidak memiliki izin untuk mengakses order ini.');
			redirect(base_url('customer/history'));
		}

		$data['order'] = $order;
		
		$data['has_sidebar'] = false;
		$this->session->unset_userdata('last_order_code');
		$this->load->view('layout/header', $data);
		$this->load->view('index/order/payment_pending', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
	}

	public function payment_failed()
	{
		is_logged_in();
		
		$user_id = $this->session->userdata('user_id');

		$data['title'] = 'Payment failed';
		
		$last_order_code = $this->session->userdata('last_order_code') ?: $this->input->get('order_id');
		if (!$last_order_code) {
			$this->session->set_flashdata('error', 'Akses halaman ini tidak diizinkan.');
			redirect(base_url('customer/history'));
		}

		$order = $this->db->get_where('orders', ['order_code' => $last_order_code])->row_array();
		if (!$order) {
			$this->session->set_flashdata('error', 'Data order tidak ditemukan.');
			redirect(base_url('customer/history'));
		}
		if ($order['user_id'] != $user_id) {
			$this->session->set_flashdata('error', 'Anda tidak memiliki izin untuk mengakses order ini.');
			redirect(base_url('customer/history'));
		}

		$data['order'] = $order;

		$data['has_sidebar'] = false;
		$this->session->unset_userdata('last_order_code');
		$this->load->view('layout/header', $data);
		$this->load->view('index/order/payment_failed', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
	}


}
