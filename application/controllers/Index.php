<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Order_model');
		$this->load->library('form_validation');
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



    public function order()
	{
		is_logged_in();

		if ($this->session->userdata('user_id')) {
			$user_id = $this->session->userdata('user_id');

			$user = $this->db->get_where('user', ['id' => $user_id])->row_array();
			$data['user'] = $user;
			$data['role_id'] = $user['role_id'];
		}

		$data['cnc_material'] = $this->db->get('cnc_material')->result_array();
		$data['cnc_finishing'] = $this->db->get('cnc_finishing')->result_array();

		$this->db->where('user_id', $user_id);
		$query = $this->db->get('cart');
		$data['carts'] = $query->result();

		$data['errors'] = $this->session->flashdata('errors') ?? [];
        $data['old'] = $this->session->flashdata('old') ?? [];
		$data['title'] = 'Order';
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
		
		$redirect = $this->input->server('HTTP_REFERER') ?? base_url('order');
		$user_id = $this->session->userdata('user_id');

		if (empty($user_id)) {
            $this->session->set_flashdata('error', 'Gagal mengakses halaman, user ID tidak ada.');
            redirect($redirect);
        }
		

		if ($this->input->method() === 'post') {
			// $this->form_validation->set_rules('gerberfile', 'Gerber File', 'required', [
			// 	'required'    => '%s wajib diisi.',
			// ]);
			// $this->form_validation->set_rules('bomfile', 'BOM File', 'required', [
			// 	'required'    => '%s wajib diisi.',
			// ]);
			// $this->form_validation->set_rules('pickandplacefile', 'Pick and Place File', 'required', [
			// 	'required'    => '%s wajib diisi.',
			// ]);

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
					'gerberfile' => ['path' => './public/web_assets/pcb_file/gerberfile/', 'allowed' => 'zip|rar'],
					'bomfile' => ['path' => './public/web_assets/pcb_file/bomfile/', 'allowed' => 'txt|csv'],
					'pickandplacefile' => ['path' => './public/web_assets/pcb_file/pickandplacefile/', 'allowed' => 'txt|csv']
				];

				$this->load->library('upload');

				$errors = [];
				$data = [];
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

					$config['upload_path'] = $config_data['path'];
					// $config['allowed_types'] = $config_data['allowed'];
					$config['allowed_types'] = '*';
					$config['file_name'] = $field . '_' . $user_id . '_' . uniqid() . '_' . time();

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
					'gerberfile'       => isset($data['gerberfile']) ? $data['gerberfile'] : null,
					'bomfile'          => isset($data['bomfile']) ? $data['bomfile'] : null,
					'pickandplacefile' => isset($data['pickandplacefile']) ? $data['pickandplacefile'] : null,
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


	public function validate_gerberfile()
	{
		if (!empty($_FILES['gerberfile']['name'])) {
			$ext = pathinfo($_FILES['gerberfile']['name'], PATHINFO_EXTENSION);
			$size = $_FILES['gerberfile']['size'] / 1024; // KB

			$allowed_ext = explode('|', $config_data['allowed']);
			if (!in_array(strtolower($ext), $allowed_ext)) {
				$this->form_validation->set_message('validate_gerberfile', 'Gerber File harus berupa file ZIP atau RAR.');
				return FALSE;
			}

			if ($size > 10240) { // 10 MB
				$this->form_validation->set_message('validate_gerberfile', 'Gerber File maksimal 10 MB.');
				return FALSE;
			}
		}
		return TRUE;
	}

	public function validate_bomfile()
	{
		if (!empty($_FILES['bomfile']['name'])) {
			$ext = pathinfo($_FILES['bomfile']['name'], PATHINFO_EXTENSION);
			$size = $_FILES['bomfile']['size'] / 1024; // KB

			$allowed_ext = explode('|', $config_data['allowed']);
			if (!in_array(strtolower($ext), $allowed_ext)) {
				$this->form_validation->set_message('validate_bomfile', 'BOM File harus berupa file TXT atau CSV.');
				return FALSE;
			}

			if ($size > 5120) { // 5 MB
				$this->form_validation->set_message('validate_bomfile', 'BOM File maksimal 5 MB.');
				return FALSE;
			}
		}
		return TRUE;
	}

	public function validate_pickandplacefile()
	{
		if (!empty($_FILES['pickandplacefile']['name'])) {
			$ext = pathinfo($_FILES['pickandplacefile']['name'], PATHINFO_EXTENSION);
			$size = $_FILES['pickandplacefile']['size'] / 1024; // KB

			$allowed_ext = explode('|', $config_data['allowed']);
			if (!in_array(strtolower($ext), $allowed_ext)) {
				$this->form_validation->set_message('validate_pickandplacefile', 'Pick and Place File harus berupa file TXT atau CSV.');
				return FALSE;
			}

			if ($size > 7168) { // 7 MB
				$this->form_validation->set_message('validate_pickandplacefile', 'Pick and Place File maksimal 7 MB.');
				return FALSE;
			}
		}
		return TRUE;
	}

}
