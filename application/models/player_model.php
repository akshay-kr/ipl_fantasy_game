<?php

class Player_model extends CI_Model {

    public function count($filter = FALSE) {
        if ($filter) {

            $this->db->where('skill', $filter);
        }

        return $this->db->get("players")->num_rows();
    }

    public function get($id = FALSE, $limit = FALSE, $start = 0, $filter = FALSE) {

        if ($id) {
            $this->db->where_in('id', $id);
        } else { // list conditions
            if ($filter) {
                $this->db->where('skill',$filter);
            }
            if ($limit) {
                $this->db->limit($limit, $start);
            }
        }

        $query = $this->db->get('players');
        return $query->result();
    }

}
