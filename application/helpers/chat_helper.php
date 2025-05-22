<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('get_total_unread_count')) {
    function get_total_unread_count() {
        $CI =& get_instance();
        $CI->load->database();
        $CI->load->library('session');

        $user_id = $CI->session->userdata('user_id');

        if (!$user_id) {
            return 0;
        }

        $CI->db->select('COUNT(*) as total_unread');
        $CI->db->from('chat');
        $CI->db->where('receiver_id', $user_id);
        $CI->db->where('is_read', 0);

        $query = $CI->db->get();
        $row = $query->row();

        return $row ? $row->total_unread : 0;
    }
}
