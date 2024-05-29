<?php

class menu_model extends CI_Model
{
    public function getData()
    {
        return $this->db->get('admin_menu')->result_array();
    }

    public function getDatabyId($id)
    {
        return $this->db->get_where('admin_menu', ['id' => $id]);
    }

    public function selectMenu()
    {
        return $this->db->get_where('admin_menu', ['id_parent' => 0])->result_array();
    }

    public function deleteData($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('admin_menu');
    }
}
