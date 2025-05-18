<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat_model extends CI_Model {

    public function get_all_customers_except($current_user_id) {
        return $this->db->where('id !=', $current_user_id)
                        ->get('users')->result_array();
    }

    public function get_chat_between($user1, $user2) {
        $this->db->select('chat.*, u.foto');
        $this->db->from('chat');
        $this->db->join('user u', 'u.id = chat.sender_id', 'left');
        $this->db->where("(sender_id = '$user1' AND receiver_id = '$user2') OR (sender_id = '$user2' AND receiver_id = '$user1')");
        $this->db->order_by('date_created', 'ASC');
        return $this->db->get()->result_array();
    }
    

    public function insert_message($data) {
        return $this->db->insert('chat', $data);
    }


    public function get_customers_with_unread_count($currentUserId)
    {
        $this->db->select('u.id, u.nama, u.foto, u.role_id, COUNT(c.chat_id) as unread_count');
        $this->db->from('user u');
        $this->db->join('chat c', 'c.sender_id = u.id AND c.receiver_id = '.$currentUserId.' AND c.is_read = 0', 'left');
        $this->db->group_by('u.id');
        $this->db->order_by('u.nama', 'asc');
        return $this->db->get()->result_array();
    }

}
