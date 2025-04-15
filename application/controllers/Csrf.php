<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Csrf extends CI_Controller {
    public function get_token() {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'token_name' => $this->security->get_csrf_token_name(),
                'token_hash' => $this->security->get_csrf_hash()
            ]));
    }
}
?>