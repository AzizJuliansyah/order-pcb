<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // $this->load->model('Blog_model');
        $this->load->library('form_validation');
        is_logged_in();
    }

    public function index()
    {
        redirect('blog/blog_list');
    }

    public function blog_list()
    {
        $data['title'] = 'Blog';
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();

        $data['errors'] = $this->session->flashdata('errors') ?? [];
		$data['old'] = $this->session->flashdata('old') ?? [];

        
        $this->db->order_by('blog_id', 'DESC');
        $data['blogs'] = $this->db->get_where('blog', ['user_id' => $user_id])->result_array();

        // Load the blog view
        $this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('blog/index', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
    }

    public function blog_management()
	{
        check_access(['2']);

		$user_id = $this->session->userdata('user_id');
		$data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();
		$data['title'] = 'Blog Management Page';
		

		$this->db->select('blog.*, user.nama, user.email, user.foto');
		$this->db->from('blog');
		$this->db->join('user', 'user.id = blog.user_id', 'left');
		$this->db->order_by('blog.date_created', 'DESC');
		$data['blogs'] = $this->db->get()->result_array();

		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('blog/blog_management', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
	}

    public function bulk_delete_blog()
    {
        $redirect     = $this->input->server('HTTP_REFERER') ?? base_url('blog/blog_management');
        $bulkIdsJson  = $this->input->post('delete_blog_ids_bulk');
        $singleId     = $this->input->post('blog_id');
        $maxBulk      = 50; // batas maksimal bulk hapus

        // Fungsi bantu untuk hapus file gambar
        $this->load->helper('file');

        // Ambil list ID blog yang akan dihapus
        $blog_ids = [];

        if ($bulkIdsJson) {
            $encrypted_ids = json_decode($bulkIdsJson, true);

            if (!is_array($encrypted_ids)) {
                $this->session->set_flashdata('error', "Format data tidak valid.");
                redirect($redirect);
            }

            foreach ($encrypted_ids as $encrypted_id) {
                $id = decrypt_id($encrypted_id);
                if ($id) {
                    $blog_ids[] = $id;
                }
            }

            if (count($blog_ids) > $maxBulk) {
                $this->session->set_flashdata('error', "Maksimal hanya bisa hapus {$maxBulk} blog sekaligus.");
                redirect($redirect);
            }
        } elseif ($singleId) {
            $id = decrypt_id($singleId);
            if ($id) {
                $blog_ids[] = $id;
            } else {
                $this->session->set_flashdata('error', "Blog ID tidak valid.");
                redirect($redirect);
            }
        } else {
            $this->session->set_flashdata('error', "Tidak ada ID blog yang dikirim.");
            redirect($redirect);
        }

        // Proses penghapusan file dan data per blog
        foreach ($blog_ids as $blog_id) {
            $blog = $this->db->get_where('blog', ['blog_id' => $blog_id])->row_array();
            if (!$blog) continue;

            // Hapus thumbnail jika ada
            if (!empty($blog['thumbnail']) && file_exists(FCPATH . 'public/' . $blog['thumbnail'])) {
                unlink(FCPATH . 'public/' . $blog['thumbnail']);
            }

            // Hapus gambar-gambar di konten
            $content = $blog['content'];
            $imageNames = [];
            $dom = new DOMDocument();
            @$dom->loadHTML($content);
            $imgTags = $dom->getElementsByTagName('img');
            foreach ($imgTags as $imgTag) {
                $imgSrc = $imgTag->getAttribute('src');
                $imgName = basename($imgSrc);
                $imageNames[] = $imgName;
            }

            $imageDirectory = FCPATH . 'public/web_assets/images/blog_content_images/';
            foreach ($imageNames as $imgName) {
                $imgPath = $imageDirectory . $imgName;
                if (file_exists($imgPath)) {
                    unlink($imgPath);
                }
            }

            // Hapus data dari database
            $this->db->delete('blog', ['blog_id' => $blog_id]);
        }

        $msg = count($blog_ids) > 1 ? count($blog_ids) . " blog berhasil dihapus." : "Blog berhasil dihapus.";
        $this->session->set_flashdata('success', $msg);
        redirect($redirect);
    }


    public function ubah_status_blog()
	{
        check_access(['2']);

		$redirect = $this->input->server('HTTP_REFERER') ?? base_url('blog/blog_management');

		$bulkIdsJson   = $this->input->post('ubahStatus_blog_ids_bulk');
		$singleId      = $this->input->post('blog_id');
		$blogStatus   = $this->input->post('blog_status');

		if ($bulkIdsJson) {
			$encrypted_ids = json_decode($bulkIdsJson, true);

			if (is_array($encrypted_ids)) {
				$blog_ids = [];
				foreach ($encrypted_ids as $encrypted_id) {
					$decrypted_id = decrypt_id($encrypted_id);
					if (!empty($decrypted_id)) {
						$blog_ids[] = $decrypted_id;
					}
				}

				foreach ($blog_ids as $blogId) {
                    $data = [];
        
                    if (!empty($blogStatus)) {
                        $data = [
                            'status' => $blogStatus,
                            'reason_rejected' => $blogStatus === 'rejected' ? $this->input->post('reason_rejected', TRUE) : null,
                        ];
                    }
        
                    if (!empty($data)) {
                        $this->db->where('blog_id', $blogId)->update('blog', $data);
                    }
                }
				$this->session->set_flashdata('success', count($blog_ids) . " blog berhasil diupdate statusnya.");
				redirect($redirect);
			} else {
				$this->session->set_flashdata('error', "Format data tidak valid.");
				redirect($redirect);
			}
		} elseif ($singleId) {
			$decrypted_id = decrypt_id($singleId);
			if (!empty($decrypted_id)) {
                if (!empty($blogStatus)) {
                    $data = [
                        'status' => $blogStatus,
                        'reason_rejected' => $blogStatus === 'rejected' ? $this->input->post('reason_rejected', TRUE) : null,
                    ];
                }
    
                if (!empty($data)) {
                    $this->db->where('blog_id', $decrypted_id)->update('blog', $data);
                }
				$this->session->set_flashdata('success', "Status blog berhasil diperbarui.");
				redirect($redirect);
			} else {
				$this->session->set_flashdata('error', "Blog ID tidak valid.");
				redirect($redirect);
			}
		} else {
			$this->session->set_flashdata('error', "Tidak ada blog ID yang dikirim.");
			redirect($redirect);
		}

		redirect($redirect);
	}

    public function pending_blog()
    {
        check_access(['2']);

        $data['title'] = 'All Pending Blog';
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();

        $data['errors'] = $this->session->flashdata('errors') ?? [];
		$data['old'] = $this->session->flashdata('old') ?? [];

        $keyword = $this->input->post('q');
		$dari = $this->input->post('dari');
		$sampai = $this->input->post('sampai');

		$page = (int) $this->input->get('page');
		$page = $page < 1 ? 1 : $page;

        $limit = 9;
		$offset = ($page - 1) * $limit;
        
        $this->db->from('blog');
        $this->db->order_by('blog_id', 'DESC');
        $this->db->where('status', 'pending');
        $this->db->join('user', 'user.id = blog.user_id', 'left');
        if ($this->input->method() === 'post') {
            if (!empty($keyword)) {
                $this->db->group_start();
                $this->db->like('user.nama', $keyword);
                $this->db->or_like('user.email', $keyword);
                $this->db->or_like('blog.title', $keyword);
                $this->db->group_end();
            }
            if (!empty($dari) && !empty($sampai) && strtotime($dari) && strtotime($sampai)) {
                $this->db->where("DATE(blog.date_created) BETWEEN '$dari' AND '$sampai'");
            }
		}

        $total_rows = $this->db->count_all_results();

        $this->db->select('blog.*, user.nama, user.email, user.foto');
		$this->db->from('blog');
        $this->db->where('status', 'pending');
		$this->db->join('user', 'user.id = blog.user_id', 'left');
        if ($this->input->method() === 'post') {
            if (!empty($keyword)) {
                $this->db->group_start();
                $this->db->like('user.nama', $keyword);
                $this->db->or_like('user.email', $keyword);
                $this->db->or_like('blog.title', $keyword);
                $this->db->group_end();
            }
            if (!empty($dari) && !empty($sampai) && strtotime($dari) && strtotime($sampai)) {
                $this->db->where("DATE(blog.date_created) BETWEEN '$dari' AND '$sampai'");
            }
        }
        $this->db->order_by('blog.date_created', 'DESC');
		$this->db->limit($limit, $offset);
		$data['blogs'] = $this->db->get()->result_array();

        // Pagination
		$config['base_url'] = base_url('blog/pending_blog');
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

        $data['search_keyword'] = $keyword;
		$data['dari'] = $dari;
		$data['sampai'] = $sampai;

        // Load the blog view
        $this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('blog/pending_blog', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
    }

    public function pending_blog_detail($slug = null)
	{
        check_access(['2']);
        
		if (empty($slug)) {
			$this->session->set_flashdata('error', 'Gagal mengakses halaman, Blog ID tidak ada.');
			redirect("blog/pending_blog");
		}

		$blog = $this->db->get_where('blog', ['slug' => $slug])->row_array();
		if (!$blog) {
			$this->session->set_flashdata('error', 'Gagal mengakses halaman, Blog ID tidak ada.');
			redirect("blog/pending_blog");
		}

		$data['blog'] = $blog;
        $data['user_info'] = $this->db->get_where('user', ['id' => $blog['user_id']])->row_array();


		$user_id = $this->session->userdata('user_id');
		$data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();
		$data['title'] = $blog['title'];

		$data['errors'] = $this->session->flashdata('errors') ?? [];
        $data['old'] = $this->session->flashdata('old') ?? [];

		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('blog/pending_blog_detail', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');	
	}

    public function submit_blog_status($encrypted_blog_id = null)
	{
        check_access(['2']);

        $redirect = $this->input->server('HTTP_REFERER') ?? base_url('default-url');
        
		$blog_id = decrypt_id($encrypted_blog_id);
        if (!$blog_id) {
            $this->session->set_flashdata('error', 'Akses halaman ini tidak diizinkan.');
            redirect($redirect);
        }
        $blog = $this->db->get_where('blog', ['blog_id' => $blog_id])->row_array();
        if (!$blog) {
            $this->session->set_flashdata('error', 'Data blog tidak ditemukan.');
            redirect($redirect);
        }

		$user_id = $this->session->userdata('user_id');

        if ($this->input->method() === 'post') {
            $status = $this->input->post('status', TRUE);
        
            $this->form_validation->set_rules('status', 'Status', 'required|trim', [
                'required' => '%s wajib diisi.'
            ]);
        
            // Validasi reason_rejected hanya jika status === rejected
            if ($status === 'rejected') {
                $this->form_validation->set_rules('reason_rejected', 'Alasan Penolakan', 'required|trim', [
                    'required' => '%s wajib diisi.'
                ]);
            }
        
            if ($this->form_validation->run() === FALSE) {
                $this->session->set_flashdata('errors', [
                    'status'          => form_error('status'),
                    'reason_rejected' => form_error('reason_rejected'),
                ]);
                $this->session->set_flashdata('old', [
                    'status'          => set_value('status'),
                    'reason_rejected' => set_value('reason_rejected'),
                ]);
                redirect($redirect);
            } else {
                $data = [
                    'admin_id' => $user_id,

                    'status' => $status,
                    'reason_rejected' => $status === 'rejected' ? $this->input->post('reason_rejected', TRUE) : null,

                    'date_published' => date('Y-m-d H:i:s'),
                    'is_edited' => 0,
                ];
                $this->db->update('blog', $data, ['blog_id' => $blog_id]);
                $this->session->set_flashdata('success', 'Berhasil merubah status blog.');
                redirect($redirect);
            }
        }
        
        redirect($redirect);
	}

    public function new_blog()
    {

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('title', 'Title', 'required|trim', [
                'required' => '%s wajib diisi.'
            ]);
            $this->form_validation->set_rules('content', 'Content', 'required|trim', [
                'required' => '%s wajib diisi.'
            ]);

            if ($this->form_validation->run() === FALSE) {
				$this->session->set_flashdata('errors', [
                    'title'            => form_error('title'),
                    'content'            => form_error('content'),
                ]);            
				$this->session->set_flashdata('old', [
                    'title'            => set_value('title'),
                    'content'       => set_value('content'),
                ]);            
				redirect('blog/new_blog');
			} else {
                $this->db->trans_start();
                $data = [
                    'user_id' => $this->session->userdata('user_id'),

                    'title' => $this->input->post('title', TRUE),
                    'slug'  => $this->generate_unique_blog_slug($this->input->post('title', TRUE)),
                    'content' => $this->input->post('content', TRUE),

                    'status' => 'pending',
                    'date_published' => null,
                ];
    
                if (!empty($_FILES['thumbnail']['name'])) {
                    $config['upload_path'] = './public/web_assets/images/blog_thumbnail_images/';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['max_size'] = 5120;
                    $config['file_name'] = 'blog' . '_' . time(); // biar unik
    
                    $this->load->library('upload', $config);
    
                    if ($this->upload->do_upload('thumbnail')) {
                        $uploadData = $this->upload->data();
                        $data['thumbnail'] = 'web_assets/images/blog_thumbnail_images/' . $uploadData['file_name'];
    
                    } else {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        $this->session->set_flashdata('old', [
                            'title'            => set_value('title'),
                            'content'       => set_value('content'),
                        ]); 
                        redirect('blog/new_blog');
                    }
                }
                $this->db->insert('blog', $data);

                $this->db->trans_complete();

                $this->session->set_flashdata('blog_status', 'new');
                $this->session->set_flashdata('blog_id', $blog_id = $this->db->insert_id());
                $this->session->set_flashdata('success', 'Berhasil membuat blog baru.');
                redirect('blog/blog_submit_success');
			}
        }


        $data['title'] = 'Blog';
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();

        $data['errors'] = $this->session->flashdata('errors') ?? [];
		$data['old'] = $this->session->flashdata('old') ?? [];


        // Load the blog view
        $this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('blog/new_blog', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
    }

    public function edit_blog($encrypted_blog_id = null)
    {
        $redirect = $this->input->server('HTTP_REFERER') ?? base_url('default-url');

        // $encrypted_blog_id = $this->input->post('blog_id');
        // if (!$encrypted_blog_id) {
        //     $this->session->set_flashdata('error', 'Akses halaman ini tidak diizinkan.');
        //     redirect($redirect);
        // }

        $blog_id = decrypt_id($encrypted_blog_id);
        if (!$blog_id) {
            $this->session->set_flashdata('error', 'Akses halaman ini tidak diizinkan.');
            redirect($redirect);
        }
        $blog = $this->db->get_where('blog', ['blog_id' => $blog_id])->row_array();
        if (!$blog) {
            $this->session->set_flashdata('error', 'Data blog tidak ditemukan.');
            redirect($redirect);
        }
        if ($blog['user_id'] != $this->session->userdata('user_id')){
            $this->session->set_flashdata('error', 'And tidak di izinkan mengkases halaman ini.');
            redirect($redirect);
        }

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('title', 'Title', 'required|trim', [
                'required' => '%s wajib diisi.'
            ]);
            $this->form_validation->set_rules('content', 'Content', 'required|trim', [
                'required' => '%s wajib diisi.'
            ]);

            if ($this->form_validation->run() === FALSE) {
				$this->session->set_flashdata('errors', [
                    'title'            => form_error('title'),
                    'content'            => form_error('content'),
                ]);            
				$this->session->set_flashdata('old', [
                    'title'            => set_value('title'),
                    'content'       => set_value('content'),
                ]);            
				redirect($redirect);
			} else {
                $this->db->trans_start();
                $data = [
                    'user_id' => $this->session->userdata('user_id'),

                    'title' => $this->input->post('title', TRUE),
                    'slug'  => $this->generate_unique_blog_slug($this->input->post('title', TRUE)),
                    'content' => $this->input->post('content', TRUE),

                    'status' => 'pending',
                    'date_edited' => date('Y-m-d H:i:s'),
                    'is_edited' => 1,
                ];
    
                if (!empty($_FILES['thumbnail']['name'])) {
                    $config['upload_path'] = './public/web_assets/images/blog_thumbnail_images/';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['max_size'] = 5120;
                    $config['file_name'] = 'blog' . '_' . time(); // biar unik
    
                    $this->load->library('upload', $config);
    
                    if ($this->upload->do_upload('thumbnail')) {
                        if (!empty($blog['thumbnail']) && file_exists(FCPATH . 'public/' . $blog['thumbnail'])) {
                            unlink(FCPATH . 'public/' . $blog['thumbnail']);
                        }
                        
                        $uploadData = $this->upload->data();
                        $data['thumbnail'] = 'web_assets/images/blog_thumbnail_images/' . $uploadData['file_name'];
    
                    } else {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        $this->session->set_flashdata('old', [
                            'title'            => set_value('title'),
                            'content'       => set_value('content'),
                        ]); 
                        redirect($redirect);
                    }
                }
                $this->db->update('blog', $data, ['blog_id' => $blog_id]);

                $this->db->trans_complete();

                $this->session->set_flashdata('blog_status', 'edit');
                $this->session->set_flashdata('blog_id', $blog['blog_id']);
                $this->session->set_flashdata('success', 'Berhasil melakukan perubahan pada blog.');
                redirect('blog/blog_submit_success');
			}
        }


        $data['title'] = 'Blog';
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();

        $data['blog'] = $blog;

        $data['errors'] = $this->session->flashdata('errors') ?? [];
		$data['old'] = $this->session->flashdata('old') ?? [];


        // Load the blog view
        $this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('blog/edit_blog', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
    }

    public function blog_submit_success()
	{
		is_logged_in();
		
		$blog_id = $this->session->flashdata('blog_id');
		// $blog_id = 6;
		$blog_status = $this->session->flashdata('blog');
		// $blog_status = 'new';
		$user_id = $this->session->userdata('user_id');

		if (!$blog_id) {
			$this->session->set_flashdata('error', 'Akses halaman ini tidak diizinkan.');
			redirect(base_url('blog/blog_list'));
		}

		$blog = $this->db->get_where('blog', ['blog_id' => $blog_id])->row_array();
		if (!$blog) {
			$this->session->set_flashdata('error', 'Data blog tidak ditemukan.');
			redirect(base_url('blog/blog_list'));
		}

		$data['blog_status'] = $blog_status;
		$data['blog'] = $blog;
		$data['title'] = 'Blog Submit Success';
		$data['has_sidebar'] = false;

		$this->load->view('layout/header', $data);
		$this->load->view('blog/blog_submit_success', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
	}

    public function delete_blog()
    {
        $redirect = $this->input->server('HTTP_REFERER') ?? base_url('default-url');
        $encrypted_blog_id = $this->input->post('blog_id');
        if (!$encrypted_blog_id) {
            $this->session->set_flashdata('error', 'Akses halaman ini tidak diizinkan.');
            redirect($redirect);
        }

        $blog_id = decrypt_id($encrypted_blog_id);
        if (!$blog_id) {
            $this->session->set_flashdata('error', 'Akses halaman ini tidak diizinkan.');
            redirect($redirect);
        }
        $blog = $this->db->get_where('blog', ['blog_id' => $blog_id])->row_array();
        if (!$blog) {
            $this->session->set_flashdata('error', 'Data blog tidak ditemukan.');
            redirect($redirect);
        }

        // Hapus thumbnail jika ada
        if (!empty($blog['thumbnail']) && file_exists(FCPATH . 'public/' . $blog['thumbnail'])) {
            unlink(FCPATH . 'public/' . $blog['thumbnail']);
        }

        $content = $blog['content'];

            $imageNames = [];
            $deskDom = new DOMDocument();
            @$deskDom->loadHTML($content);
            $deskImgTags = $deskDom->getElementsByTagName('img');
            foreach ($deskImgTags as $imgTag) {
                $imgSrc = $imgTag->getAttribute('src');
                $imgName = basename($imgSrc);
                $imageNames[] = $imgName;
            }

            $imageDirectory = FCPATH . 'public/web_assets/images/blog_content_images/';
            foreach ($imageNames as $imageName) {
                $imagePath = $imageDirectory . $imageName;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

        $this->db->delete('blog', ['blog_id' => $blog_id]);

        $this->session->set_flashdata('success', 'Blog berhasil dihapus.');
        redirect($redirect);
    }



    private function generate_unique_blog_slug($title)
    {
        $CI =& get_instance();
        $CI->load->database();

        $slug = url_title($title, 'dash', TRUE);
        $original_slug = $slug;
        $i = 1;

        while ($CI->db->where('slug', $slug)->get('blog')->num_rows() > 0) {
            $slug = $original_slug . '-' . $i;
            $i++;
        }

        return $slug;
    }



    public function blog_content_images()
    {
        $uploadPath = 'web_assets/images/blog_content_images/'; 

        if (!empty($_FILES['upload']['name'])) {
            $config['upload_path'] = 'public/' . $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048; 
            $config['encrypt_name'] = TRUE; 
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('upload')) {
                $uploadData = $this->upload->data();
                $fileName = $uploadData['file_name'];
                $url = base_url('public/web_assets/images/blog_content_images/' . $fileName);
                $response = array(
                    'uploaded' => true,
                    'url' => $url,
                    'message' => 'File uploaded successfully.'
                );
            } else {
                $response = array(
                    'uploaded' => false,
                    'message' => $this->upload->display_errors('', '')
                );
            }
        } else {
            $response = array(
                'uploaded' => false,
                'message' => 'No file uploaded.'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }


    public function blog_content_images_delete()
    {
            $inputData = file_get_contents('php://input');
            $data = json_decode($inputData, true); 
            $filename = $data['filename'] ?? null;

            if ($filename) {
                $imagePath = FCPATH . 'public/web_assets/images/blog_content_images/' . $filename;
                if (file_exists($imagePath)) {
                    if (unlink($imagePath)) {
                        echo json_encode(array('success' => true));
                    } else {
                        echo json_encode(array('success' => false, 'message' => 'Unable to delete file'));
                    }
                } else {
                    echo json_encode(array('success' => false, 'message' => 'File not found'));
                }
            } else {
                echo json_encode(array('success' => false, 'message' => 'Filename is missing'));
            }
    }

    public function delete_temp_images()
    {
        $inputData = file_get_contents('php://input');
        $data = json_decode($inputData, true); 
        $filenames = $data['filenames'] ?? [];

        foreach ($filenames as $filename) {
            $imagePath = FCPATH . 'public/web_assets/images/blog_content_images/' . $filename;
            if (file_exists($imagePath)) {
                unlink($imagePath); // Optional: log error if needed
            }
        }

        // Tidak perlu response karena sendBeacon tidak menunggu
    }

    
}