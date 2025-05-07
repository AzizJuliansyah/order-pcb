<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('set_active')) {
    /**
     * Cek active menu
     * 
     * @param array $segments List segment atau uri_string
     * @param string $class Nama class aktif (default 'active')
     * @param int|null $uri_segment Segment ke berapa (default 2). Kalau null, cek uri_string full.
     * 
     * @return string
     */
    function set_active($segments = [], $class = 'active', $uri_segment = 2)
    {
        $CI =& get_instance();

        if (is_null($uri_segment)) {
            $current = uri_string(); // misal: admin/order_management
        } else {
            $current = $CI->uri->segment($uri_segment); // ambil segment ke-x
        }

        if (in_array($current, (array)$segments)) {
            return $class;
        }

        return '';
    }


    function set_active_with_from($page, $from_check, $class = 'active')
{
    $CI =& get_instance();

    $current_page = $CI->uri->segment(2); // ambil misal 'order_detail'
    $from_param = $CI->input->get('from'); // ambil ?from=xxx

    if ($current_page === $page && $from_param === $from_check) {
        return $class;
    }

    return '';
}

}
