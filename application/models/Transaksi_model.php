<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{
    public function generate_no_transaksi()
    {
        $tanggal = date('Ymd');
        $prefix = 'TRX-' . $tanggal . '-';
        $last = $this->db
            ->like('no_transaksi', $prefix, 'after')
            ->order_by('id', 'DESC')
            ->limit(1)
            ->get('transaksi')
            ->row();

        $nomor = 1;
        if ($last) {
            $nomor = (int) substr($last->no_transaksi, -4) + 1;
        }

        return $prefix . str_pad($nomor, 4, '0', STR_PAD_LEFT);
    }

    public function simpan($transaksi, $keranjang)
    {
        $this->db->trans_begin();
        $this->db->insert('transaksi', $transaksi);
        $id_transaksi = $this->db->insert_id();

        foreach ($keranjang as $item) {
            $produk = $this->db->where('id', $item['id_produk'])->get('produk')->row();
            if (!$produk || $produk->stok < $item['qty']) {
                $this->db->trans_rollback();
                return FALSE;
            }

            $this->db->insert('detail_transaksi', [
                'id_transaksi' => $id_transaksi,
                'id_produk' => $item['id_produk'],
                'nama_produk' => $item['nama_produk'],
                'harga_satuan' => $item['harga_satuan'],
                'qty' => $item['qty'],
                'subtotal' => $item['subtotal']
            ]);

            $this->db
                ->set('stok', 'stok - ' . (int) $item['qty'], FALSE)
                ->where('id', $item['id_produk'])
                ->update('produk');
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }

        $this->db->trans_commit();
        return $id_transaksi;
    }

    public function get_by_id($id)
    {
        return $this->db
            ->select('transaksi.*, users.nama AS nama_user')
            ->from('transaksi')
            ->join('users', 'users.id = transaksi.id_user', 'left')
            ->where('transaksi.id', $id)
            ->get()
            ->row();
    }

    public function get_detail($id_transaksi)
    {
        return $this->db
            ->where('id_transaksi', $id_transaksi)
            ->get('detail_transaksi')
            ->result();
    }

    public function get_latest($limit = 5)
    {
        return $this->db
            ->select('transaksi.*, users.nama AS nama_user')
            ->from('transaksi')
            ->join('users', 'users.id = transaksi.id_user', 'left')
            ->order_by('transaksi.id', 'DESC')
            ->limit($limit)
            ->get()
            ->result();
    }

    public function count_hari_ini()
    {
        return $this->db
            ->where('DATE(tanggal)', date('Y-m-d'))
            ->count_all_results('transaksi');
    }

    public function pendapatan_hari_ini()
    {
        $row = $this->db
            ->select_sum('total')
            ->where('DATE(tanggal)', date('Y-m-d'))
            ->get('transaksi')
            ->row();

        return $row && $row->total ? $row->total : 0;
    }

    public function get_laporan($tanggal_mulai, $tanggal_selesai)
    {
        return $this->db
            ->select('transaksi.*, users.nama AS nama_user')
            ->from('transaksi')
            ->join('users', 'users.id = transaksi.id_user', 'left')
            ->where('DATE(transaksi.tanggal) >=', $tanggal_mulai)
            ->where('DATE(transaksi.tanggal) <=', $tanggal_selesai)
            ->order_by('transaksi.tanggal', 'DESC')
            ->get()
            ->result();
    }

    public function total_laporan($tanggal_mulai, $tanggal_selesai)
    {
        $row = $this->db
            ->select_sum('total')
            ->where('DATE(tanggal) >=', $tanggal_mulai)
            ->where('DATE(tanggal) <=', $tanggal_selesai)
            ->get('transaksi')
            ->row();

        return $row && $row->total ? $row->total : 0;
    }
}
