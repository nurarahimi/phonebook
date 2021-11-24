<?php
class Test_model extends CI_Model{
   
    function get_phone_info($limit, $start){
        $query = $this->db->get('phone_info', $limit, $start);
        return $query;
    }
}