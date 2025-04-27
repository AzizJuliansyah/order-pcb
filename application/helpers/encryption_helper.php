<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    if (!function_exists('encrypt_id')) {
        function encrypt_id($id)
        {
            $CI =& get_instance();
            $CI->load->library('encryption');
            $encrypted = $CI->encryption->encrypt($id);
            $encrypted_url_safe = strtr(base64_encode($encrypted), '+/=', '-_,');
            return $encrypted_url_safe;
        }
    }

    if (!function_exists('decrypt_id')) {
        function decrypt_id($encrypted_id)
        {
            $CI =& get_instance();
            $CI->load->library('encryption');
            $encrypted = base64_decode(strtr($encrypted_id, '-_,', '+/='));
            return $CI->encryption->decrypt($encrypted);
        }
    }

?>
