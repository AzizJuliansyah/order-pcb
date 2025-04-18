<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function get_website_logo()
{
    $CI =& get_instance();
    $query = $CI->db->get_where('settings', ['id' => 3])->row_array();
    return $query['item'] ?? 'none';
}

function get_website_name()
{
    $CI =& get_instance();
    $query = $CI->db->get_where('settings', ['id' => 4])->row_array();
    return $query['item'] ?? 'none';
}

?>