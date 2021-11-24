<?php

class Find extends CI_Model {

    function get_live_items($search_data) {

        $this->db->select("p_username, p_phonenum");

        $this->db->from('phone_info');
        $this->db->group_start();
        $this->db->like('p_username', $search_data);
        $this->db->or_like('p_phonenum', $search_data);
        $this->db->group_end();

        $this->db->limit(10);
        $this->db->order_by("id", 'desc');
        $query = $this->db->get();

        return $query->result();
    }

}