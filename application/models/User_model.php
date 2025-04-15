<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function get_user_by_id($user_id)
    {
        return $this->db->get_where('user', ['id' => $user_id])->row_array();
    }

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

    public function get_roles_with_user_count()
    {
        $query = $this->db->query("
            SELECT 
                r.role_id, 
                r.jabatan, 
                COUNT(u.id) AS total_user,
                SUM(CASE WHEN u.is_active = 1 THEN 1 ELSE 0 END) AS total_aktif,
                SUM(CASE WHEN u.is_active = 0 THEN 1 ELSE 0 END) AS total_nonaktif,
                MAX(u.created_at) AS last_created
            FROM role r
            LEFT JOIN user u ON u.role_id = r.role_id
            GROUP BY r.role_id
            ORDER BY r.role_id ASC
        ");

        return $query->result_array();
    }

}
