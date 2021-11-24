<?php

class Crud_model extends CI_Model
{

    public function get_entries()
    {
        $query = $this->db->get('phone_info');
        // if (count($query->result()) > 0) {
        return $query->result_array();
        // }
    }

    public function insert_entry($data)
    {
        return $this->db->insert('phone_info', $data);
    }

    public function delete_entry($p_id)
    {
        return $this->db->delete('phone_info', array('p_id' => $p_id));
    }

    public function single_entry($p_id)
    {
        $this->db->select('*');
        $this->db->from('phone_info');
        $this->db->where('p_id', $p_id);
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }

    public function update_entry($data)
    {
        return $this->db->update('phone_info', $data, array('p_id' => $data['p_id']));
    }

    
}