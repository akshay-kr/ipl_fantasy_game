<?php

class Player_model extends CI_Model {

    public function count($filters = FALSE) {
        if ($filters) {

            $this->db->where($filters);
        }

        return $this->db->get("players")->num_rows();
    }

    public function get($id = FALSE, $limit = FALSE, $start = 0, $filters = FALSE) {

        if ($id) {
            $this->db->where_in('id', $id);
        } else { // list conditions
            if ($filters) {
                $this->db->where($filters);
            }
            if ($limit) {
                $this->db->limit($limit, $start);
            }
        }

        $query = $this->db->get('players');
        return $query->result();
    }

}
