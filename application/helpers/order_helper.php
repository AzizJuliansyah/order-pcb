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

if (!function_exists('get_admin_name')) {
    function get_admin_name($id) {
        $CI =& get_instance();
        $CI->load->database();

        $query = $CI->db->get_where('user', ['id' => $id])->row();
        if ($query) {
            return $query->nama;
        }

        return '-';
    }
}


if (!function_exists('get_shipping_status_name')) {
    function get_shipping_status_name($id) {
        $CI =& get_instance();
        $CI->load->database();

        $query = $CI->db->get_where('shipping_status', ['id' => $id])->row();
        if ($query) {
            return $query->nama;
        }

        return '-';
    }
}

if (!function_exists('get_midtrans_credential')) {
    function get_midtrans_credential($settings_id) {
        $CI =& get_instance();
        $CI->load->database();

        $query = $CI->db->get_where('settings', ['settings_id' => $settings_id])->row();
        if ($query) {
            return $query->item;
        }

        return '-';
    }
}

?>
