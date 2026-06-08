<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model
{
    public function get_all()
    {
        return $this->db
            ->select('produk.*, kategori.nama_kategori')
            ->from('produk')
            ->join('kategori', 'kategori.id = produk.id_kategori', 'left')
            ->order_by('produk.nama_produk', 'ASC')
            ->get()
            ->result();
    }

    public function get_available()
    {
        return $this->db
            ->select('produk.*, kategori.nama_kategori')
            ->from('produk')
            ->join('kategori', 'kategori.id = produk.id_kategori', 'left')
            ->where('produk.stok >', 0)
            ->order_by('produk.nama_produk', 'ASC')
            ->get()
            ->result();
    }

    public function get_latest($limit = 5)
    {
        return $this->db
            ->select('produk.*, kategori.nama_kategori')
            ->from('produk')
            ->join('kategori', 'kategori.id = produk.id_kategori', 'left')
            ->order_by('produk.id', 'DESC')
            ->limit($limit)
            ->get()
            ->result();
    }

    public function get_by_id($id)
    {
        return $this->db->where('id', $id)->get('produk')->row();
    }

    public function insert($data)
    {
        return $this->db->insert('produk', $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update('produk', $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete('produk');
    }

    public function count_all()
    {
        return $this->db->count_all('produk');
    }

    public function count_stok_menipis($batas = 10)
    {
        return $this->db->where('stok <=', $batas)->count_all_results('produk');
    }
}
