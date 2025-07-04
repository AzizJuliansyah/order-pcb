<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        
    }

    public function index()
    {
        if ($this->session->userdata('user_id')) {
            $user_id = $this->session->userdata('user_id');
			$user = $this->db->get_where('user', ['id' => $user_id])->row_array();
			$data['user'] = $user;
			$data['role_id'] = $user['role_id'];
		}
        
        $data['errors'] = $this->session->flashdata('errors') ?? [];
        $data['old'] = $this->session->flashdata('old') ?? [];

        $data['title'] = 'Blog';

        $keyword = $this->input->get('q');
        $this->db->from('blog');
        $this->db->where('status', 'approved');
        if (!empty($keyword)) {
            $this->db->like('title', $keyword);
        }
        $total_rows = $this->db->count_all_results();

        $this->load->library('pagination');
        $config['base_url'] = base_url('blog/index');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = 36;
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

        $limit = $config['per_page'];
        $start = $this->input->get('page');
        $start = ($start) ? $start : 0;

        $this->db->from('blog');
        $this->db->where('status', 'approved');
        if (!empty($keyword)) {
            $this->db->like('title', $keyword);
        }

        $this->db->order_by('blog_id', 'DESC');
        $this->db->limit($limit, $start);
        $data['blogs'] = $this->db->get()->result_array();
        $data['pagination'] = $this->pagination->create_links();
        $data['total'] = $total_rows;
        $data['start'] = $start + 1;
        $data['end'] = min($start + $limit, $total_rows);
        $data['keyword'] = $keyword;

        $data['has_sidebar'] = false;
        $this->load->view('blog/index', $data);
        $this->load->view('layout/alert');
    }

    public function view_blog($slug = null)
	{
        if ($this->session->userdata('user_id')) {
			$user_id = $this->session->userdata('user_id');
			$user = $this->db->get_where('user', ['id' => $user_id])->row_array();
			$data['user'] = $user;
			$data['role_id'] = $user['role_id'];
		}

		$data['errors'] = $this->session->flashdata('errors') ?? [];
        $data['old'] = $this->session->flashdata('old') ?? [];

        

		if (empty($slug)) {
			$this->session->set_flashdata('error', 'Gagal mengakses halaman, Blog ID tidak ada.');
			redirect("blog/pending_blog");
		}

		$blog = $this->db->get_where('blog', ['slug' => $slug])->row_array();
		if (!$blog) {
			$this->session->set_flashdata('error', 'Gagal mengakses halaman, Blog ID tidak ada.');
			redirect("blog/pending_blog");
		}

        if ($user['role_id'] != '2') {
            if ($blog['status'] == 'pending' || $blog['status'] == 'rejected') {
                if ($blog['user_id'] != $user_id) {
                    $this->session->set_flashdata('error', 'Blog ini belum bisa di akses oleh publik, harap login terlebih dahulu!');
                    redirect('blog');
                }
            }
        }

		$data['blog'] = $blog;
        $data['user_info'] = $this->db->get_where('user', ['id' => $blog['user_id']])->row_array();

        $this->db->where('status', 'approved');
        $this->db->where('blog_id !=', $blog['blog_id']);
        $this->db->order_by('blog_id', 'DESC');
        $this->db->limit(4);
        $data['blogs'] = $this->db->get('blog')->result_array();

        $data['title'] = $blog['title'];
        $data['has_sidebar'] = false;
		$this->load->view('blog/view_blog', $data);
        $this->load->view('layout/alert');
	}


    public function blog_list()
    {
        is_logged_in();
        
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();
        
        $data['errors'] = $this->session->flashdata('errors') ?? [];
		$data['old'] = $this->session->flashdata('old') ?? [];

        $data['title'] = 'Blog';

        $this->db->order_by('blog_id', 'DESC');
        $data['blogs'] = $this->db->get_where('blog', ['user_id' => $user_id])->result_array();

        $this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('blog/blog_list', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
    }

    public function blog_management()
	{
        is_logged_in();
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
        is_logged_in();

        $redirect     = $this->input->server('HTTP_REFERER') ?? base_url('blog/blog_management');
        $bulkIdsJson  = $this->input->post('delete_blog_ids_bulk');
        $singleId     = $this->input->post('blog_id');
        $maxBulk      = 50; // batas maksimal bulk hapus

        $this->load->helper('file');
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

        foreach ($blog_ids as $blog_id) {
            $blog = $this->db->get_where('blog', ['blog_id' => $blog_id])->row_array();
            if (!$blog) continue;

            if (!empty($blog['thumbnail']) && file_exists(FCPATH . 'public/' . $blog['thumbnail'])) {
                unlink(FCPATH . 'public/' . $blog['thumbnail']);
            }

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

            $this->db->delete('blog', ['blog_id' => $blog_id]);
        }

        $jumlah = count($blog_ids);
        if ($jumlah < 1) {
            $this->session->set_flashdata('error', "Tidak ada blog yang dipilih untuk dihapus.");
        } else {
            $this->session->set_flashdata('success', "$jumlah blog berhasil dihapus.");
        }
        redirect($redirect);
    }


    public function ubah_status_blog()
    {
        is_logged_in();
        check_access(['2']);

        $redirect = $this->input->server('HTTP_REFERER') ?? base_url('blog/blog_management');

        $bulkIdsJson  = $this->input->post('ubahStatus_blog_ids_bulk');
        $singleId     = $this->input->post('blog_id');
        $blogStatus   = $this->input->post('blog_status');
        $maxBulk      = 50;

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
                $this->session->set_flashdata('error', "Maksimal hanya bisa ubah status {$maxBulk} blog sekaligus.");
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

        $updated = 0;

        foreach ($blog_ids as $blog_id) {
            $data = [];

            if (!empty($blogStatus)) {
                $data = [
                    'status' => $blogStatus,
                    'reason_rejected' => $blogStatus === 'rejected' ? $this->input->post('reason_rejected', TRUE) : null,
                ];
            }

            if (!empty($data)) {
                $this->db->where('blog_id', $blog_id)->update('blog', $data);
                $updated++;
            }
        }

        if ($updated < 1) {
            $this->session->set_flashdata('error', "Tidak ada blog yang berhasil diubah statusnya.");
        } else {
            $this->session->set_flashdata('success', "$updated blog berhasil diubah statusnya.");
        }

        redirect($redirect);
    }


    public function pending_blog()
    {
        is_logged_in();
        check_access(['2']);

        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();
        
        $data['errors'] = $this->session->flashdata('errors') ?? [];
		$data['old'] = $this->session->flashdata('old') ?? [];

        $data['title'] = 'All Pending Blog';

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

        $this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('blog/pending_blog', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
    }

    public function pending_blog_detail($slug = null)
	{
        is_logged_in();
        check_access(['2']);

        $user_id = $this->session->userdata('user_id');
		$data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();
        
		$data['errors'] = $this->session->flashdata('errors') ?? [];
        $data['old'] = $this->session->flashdata('old') ?? [];
        
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

        $data['title'] = $blog['title']; 
		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('blog/pending_blog_detail', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');	
	}

    public function submit_blog_status($encrypted_blog_id = null)
	{
        is_logged_in();
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
            $this->form_validation->set_rules('status', 'Status', 'required|trim', [
                'required' => '%s wajib diisi.'
            ]);
            
            $status = $this->input->post('status', TRUE);
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
                    // 'is_edited' => 0,
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
        is_logged_in();

        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();
        
        $data['errors'] = $this->session->flashdata('errors') ?? [];
		$data['old'] = $this->session->flashdata('old') ?? [];

        $data['title'] = 'Blog';

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
                
                $this->session->set_flashdata('blog_status', 'new');
                $this->session->set_flashdata('blog_id', $this->db->insert_id());
                $this->session->set_flashdata('success', 'Berhasil membuat blog baru.');
                $this->db->trans_complete();
                redirect('blog/blog_submit_success');
			}
        }

        $this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('blog/new_blog', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
    }

    public function edit_blog($encrypted_blog_id = null)
    {
        is_logged_in();
        $redirect = $this->input->server('HTTP_REFERER') ?? base_url('default-url');

        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();

        $data['errors'] = $this->session->flashdata('errors') ?? [];
		$data['old'] = $this->session->flashdata('old') ?? [];

        $data['title'] = 'Blog';

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
                    $config['file_name'] = 'blog' . '_' . time();
    
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
                
                $this->session->set_flashdata('blog_status', 'edit');
                $this->session->set_flashdata('blog_id', $blog['blog_id']);
                $this->session->set_flashdata('success', 'Berhasil melakukan perubahan pada blog.');
                $this->db->trans_complete();
                redirect('blog/blog_submit_success');
			}
        }

        $data['blog'] = $blog;

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
		$data['title'] = 'Blog Submit Success';
		
		$blog_id = $this->session->flashdata('blog_id');
		$blog_status = $this->session->flashdata('blog_status');
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
        
		$data['has_sidebar'] = false;
		$this->load->view('layout/header', $data);
		$this->load->view('blog/blog_submit_success', $data);
		$this->load->view('layout/alert');
		$this->load->view('layout/footer');
	}

    public function delete_blog()
    {
        is_logged_in();
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
                unlink($imagePath);
            }
        }
    }

    
}