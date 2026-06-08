<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model
{
    public function get_all()
    {
        return $this->db->order_by('nama_kategori', 'ASC')->get('kategori')->result();
    }

    public function get_by_id($id)
    {
        return $this->db->where('id', $id)->get('kategori')->row();
    }

    public function insert($data)
    {
        return $this->db->insert('kategori', $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update('kategori', $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete('kategori');
    }
}
