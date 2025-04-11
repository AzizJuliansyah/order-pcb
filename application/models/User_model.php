<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function insert_user($data)
    {
        return $this->db->insert('user', $data);
    }

    public function update_user($user_id, $data)
    {
        $this->db->where('id', $user_id);
        return $this->db->update('user', $data);
    }


    public function get_user_with_role($user_id)
    {
        $this->db->select('user.*, role.jabatan');
        $this->db->from('user');
        $this->db->join('role', 'role.role_id = user.role_id');
        $this->db->where('user.id', $user_id);
        return $this->db->get()->row_array();
    }
}
