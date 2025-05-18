<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function is_logged_in()
{
    $CI =& get_instance();
    if (!$CI->session->userdata('user_id')) {
        $CI->session->set_flashdata('error', 'Silakan login terlebih dahulu.');
        redirect('auth/login');
    }
}

function is_guest_redirect()
{
    $CI =& get_instance();
    if ($CI->session->userdata('user_id')) {
        $CI->session->set_flashdata('error', 'Anda sudah login, silakan logout terlebih dahulu.');
        redirect('index/home');
    }
}

function check_access($allowed_roles = [])
{
    $CI =& get_instance();
    $role_id = $CI->session->userdata('role_id');

    if (!in_array($role_id, $allowed_roles)) {
        // Akses ditolak
        $CI->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        redirect('user/profile');
    }
}

function has_access($allowed_roles = [])
{
    $CI =& get_instance();
    $role_id = $CI->session->userdata('role_id');
    return in_array($role_id, $allowed_roles);
}

function get_user_role($id) {
    $CI =& get_instance();
    $CI->load->database();

    $query = $CI->db->get_where('role', ['role_id' => $id])->row();
    if ($query) {
        return $query->jabatan;
    }

    return '-';
}