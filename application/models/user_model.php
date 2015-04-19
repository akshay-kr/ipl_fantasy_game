<?php

class User_model extends CI_Model {

    public function add($data, $condition = FALSE) {
        $this->db->insert('user', $data);
        return TRUE;
    }

    public function validate($username, $password = FAlSE) {

        if ($username && !$password) {
            $this->db->where('username', $username);
        }
        if ($username && $password) {
            $this->db->where(array('username' => $username, 'password' => $password));
        }
        $query = $this->db->get('user');
        return $query->result();
    }

}
