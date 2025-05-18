<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Chat_model');
    }

    public function index() 
    {
        if ($this->session->userdata('user_id')) {
            $user_id = $this->session->userdata('user_id');
    
            $user = $this->db->get_where('user', ['id' => $user_id])->row_array();
            $data['user'] = $user;
            $data['role_id'] = $user['role_id'];
        }
    
        $role_id = $user['role_id'];
    
        if (in_array($role_id, [1, 2, 3, 5])) {
            $this->db->select('user.id, user.nama, user.role_id, user.foto,
                (SELECT COUNT(*) FROM chat
                 WHERE chat.sender_id = user.id
                 AND chat.receiver_id = ' . $user_id . '
                 AND chat.is_read = 0) AS unread_count
            ');
            $this->db->from('user');
            $this->db->where('role_id', 4); // hanya customer service
            $this->db->order_by('user.nama', 'ASC');
            $data['users'] = $this->db->get()->result_array();
    
        } elseif ($role_id == 4) {
            $this->db->select('u.id, u.nama, u.role_id, u.foto,
                (SELECT COUNT(*) FROM chat 
                 WHERE chat.sender_id = u.id 
                 AND chat.receiver_id = ' . $user_id . ' 
                 AND chat.is_read = 0) AS unread_count,
                MAX(c.date_created) AS last_chat_date');
            $this->db->from('chat c');
            $this->db->join('user u', 'u.id = IF(c.sender_id = ' . $user_id . ', c.receiver_id, c.sender_id)');
            $this->db->group_start();
            $this->db->where('c.sender_id', $user_id);
            $this->db->or_where('c.receiver_id', $user_id);
            $this->db->group_end();
            $this->db->group_by('u.id');
            $this->db->order_by('last_chat_date', 'DESC');
            $data['users'] = $this->db->get()->result_array();
        } else {
            $data['users'] = [];
        }
    
        $data['title'] = 'Chat Page';
    
        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('index/chat/index', $data);
        $this->load->view('layout/alert');
        $this->load->view('layout/footer');
    }
    

    public function load_messages()
    {
        $receiver_id = $this->input->post('user_id');
        $sender_id = $this->session->userdata('user_id');

        $this->db->where('sender_id', $receiver_id);
        $this->db->where('receiver_id', $sender_id);
        $this->db->where('is_read', 0);
        $this->db->update('chat', ['is_read' => 1]);

        $data['messages'] = $this->Chat_model->get_chat_between($sender_id, $receiver_id);
        $data['sender_id'] = $sender_id;

        $this->load->view('index/chat/chat_messages_partial', $data);
    }

    public function get_unread_counts() {
        $user_id = $this->session->userdata('user_id');
    
        $this->db->select('u.id, u.nama, u.foto, r.jabatan as role_nama,
            (SELECT COUNT(*) FROM chat 
             WHERE sender_id = u.id 
             AND receiver_id = ' . $user_id . ' 
             AND is_read = 0) AS unread_count,
            MAX(c.date_created) AS last_chat_date');
        $this->db->from('chat c');
        $this->db->join('user u', 'u.id = IF(c.sender_id = ' . $user_id . ', c.receiver_id, c.sender_id)');
        $this->db->join('role r', 'r.role_id = u.role_id');
        $this->db->group_start();
        $this->db->where('c.sender_id', $user_id);
        $this->db->or_where('c.receiver_id', $user_id);
        $this->db->group_end();
        $this->db->group_by(['u.id', 'u.nama', 'u.foto', 'r.jabatan']);
        $this->db->order_by('last_chat_date', 'DESC');
    
        $result = $this->db->get()->result_array();
        echo json_encode($result);
    }
    
    
    
    


    public function send_message()
    {
        $data = [
            'sender_id' => $this->session->userdata('user_id'),
            'receiver_id' => $this->input->post('receiver_id'),
            'message' => $this->input->post('message'),
            'is_read' => 0,
        ];
        $this->db->insert('chat', $data);
    }


    public function mark_as_read()
    {
        $receiver_id = $this->session->userdata('user_id');
        $sender_id = $this->input->post('sender_id');

        $this->db->where('sender_id', $sender_id);
        $this->db->where('receiver_id', $receiver_id);
        $this->db->where('is_read', 0);
        $this->db->update('chat', ['is_read' => 1]);
    }

}
