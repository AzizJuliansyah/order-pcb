<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model
{

    public function update_settings($settings_id, $data)
    {
        $this->db->where('id', $settings_id);
        return $this->db->update('settings', $data);
    }

    public function get_website_logo()
    {
        $query = $this->db->get_where('settings', ['id' => 3])->row_array();
        return $query['item'] ?? null;
    }
}
