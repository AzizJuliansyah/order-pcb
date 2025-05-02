<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('get_cnc_material_name')) {
    function get_cnc_material_name($id) {
        $CI =& get_instance();
        $CI->load->database();

        $query = $CI->db->get_where('cnc_material', ['id' => $id])->row();
        if ($query) {
            return $query->nama;
        }

        return '-';
    }
}

if (!function_exists('get_cnc_finishing_name')) {
    function get_cnc_finishing_name($id) {
        $CI =& get_instance();
        $CI->load->database();

        $query = $CI->db->get_where('cnc_finishing', ['id' => $id])->row();
        if ($query) {
            return $query->nama;
        }

        return '-';
    }
}

?>
