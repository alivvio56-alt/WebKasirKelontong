<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect('auth');
        }
        $this->load->model('Produk_model');
        $this->load->model('Transaksi_model');
    }

    public function index()
    {
        $keranjang = $this->session->userdata('keranjang');
        if (!is_array($keranjang)) {
            $keranjang = [];
            $this->session->set_userdata('keranjang', $keranjang);
        }

        $data['judul'] = 'Transaksi Kasir';
        $data['produk'] = $this->Produk_model->get_available();
        $data['keranjang'] = $keranjang;
        $data['total'] = $this->_hitung_total($keranjang);
        $this->load->view('transaksi/index', $data);
    }

    public function tambah_keranjang()
    {
        $id_produk = (int) $this->input->post('id_produk', TRUE);
        $qty = (int) $this->input->post('qty', TRUE);
        $qty = $qty > 0 ? $qty : 1;
        $produk = $this->Produk_model->get_by_id($id_produk);

        if (!$produk) {
            $this->session->set_flashdata('error', 'Produk tidak ditemukan.');
            redirect('transaksi');
        }

        $keranjang = $this->session->userdata('keranjang');
        $keranjang = is_array($keranjang) ? $keranjang : [];
        $qty_lama = isset($keranjang[$id_produk]) ? (int) $keranjang[$id_produk]['qty'] : 0;
        $qty_baru = $qty_lama + $qty;

        if ($qty_baru > $produk->stok) {
            $this->session->set_flashdata('error', 'Stok ' . $produk->nama_produk . ' tidak mencukupi. Stok tersedia: ' . $produk->stok . '.');
            redirect('transaksi');
        }

        $keranjang[$id_produk] = [
            'id_produk'    => $produk->id,
            'nama_produk'  => $produk->nama_produk,
            'harga_satuan' => $produk->harga_jual,
            'qty'          => $qty_baru,
            'subtotal'     => $produk->harga_jual * $qty_baru
        ];

        $this->session->set_userdata('keranjang', $keranjang);
        redirect('transaksi');
    }

    public function hapus_item($id_produk)
    {
        $keranjang = $this->session->userdata('keranjang');
        $keranjang = is_array($keranjang) ? $keranjang : [];
        unset($keranjang[$id_produk]);
        $this->session->set_userdata('keranjang', $keranjang);
        redirect('transaksi');
    }

    public function kosongkan()
    {
        $this->session->unset_userdata('keranjang');
        redirect('transaksi');
    }

    public function proses()
    {
        $keranjang = $this->session->userdata('keranjang');
        $keranjang = is_array($keranjang) ? $keranjang : [];

        if (empty($keranjang)) {
            $this->session->set_flashdata('error', 'Keranjang masih kosong.');
            redirect('transaksi');
        }

        $total = $this->_hitung_total($keranjang);
        $bayar = (float) $this->input->post('bayar', TRUE);

        if ($bayar < $total) {
            $this->session->set_flashdata('error', 'Uang bayar kurang.');
            redirect('transaksi');
        }

        $data = [
            'no_transaksi' => $this->Transaksi_model->generate_no_transaksi(),
            'total'        => $total,
            'bayar'        => $bayar,
            'kembalian'    => $bayar - $total,
            'id_user'      => $this->session->userdata('id_user')
        ];

        $id_transaksi = $this->Transaksi_model->simpan($data, $keranjang);
        if (!$id_transaksi) {
            $this->session->set_flashdata('error', 'Transaksi gagal disimpan. Periksa stok produk.');
            redirect('transaksi');
        }

        $this->session->unset_userdata('keranjang');
        redirect('transaksi/detail/' . $id_transaksi);
    }

    public function detail($id)
    {
        $data['judul'] = 'Detail Transaksi';
        $data['transaksi'] = $this->Transaksi_model->get_by_id($id);
        if (!$data['transaksi']) {
            show_404();
        }
        $data['detail'] = $this->Transaksi_model->get_detail($id);
        $this->load->view('transaksi/detail', $data);
    }

    private function _hitung_total($keranjang)
    {
        $total = 0;
        foreach ($keranjang as $item) {
            $total += $item['subtotal'];
        }
        return $total;
    }
}
