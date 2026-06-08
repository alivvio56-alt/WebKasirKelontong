<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect('auth');
        }
        $this->load->model('Produk_model');
        $this->load->model('Kategori_model');
    }

    public function index()
    {
        $data['judul'] = 'Produk';
        $data['produk'] = $this->Produk_model->get_all();
        $this->load->view('produk/index', $data);
    }

    public function tambah()
    {
        $this->_rules();
        if ($this->form_validation->run() === FALSE) {
            $data['judul'] = 'Tambah Produk';
            $data['kategori'] = $this->Kategori_model->get_all();
            $this->load->view('produk/tambah', $data);
            return;
        }

        $this->Produk_model->insert($this->_post_data());
        $this->session->set_flashdata('success', 'Produk berhasil ditambahkan.');
        redirect('produk');
    }

    public function edit($id)
    {
        $data['produk'] = $this->Produk_model->get_by_id($id);
        if (!$data['produk']) {
            show_404();
        }

        $this->_rules($id);
        if ($this->form_validation->run() === FALSE) {
            $data['judul'] = 'Edit Produk';
            $data['kategori'] = $this->Kategori_model->get_all();
            $this->load->view('produk/edit', $data);
            return;
        }

        $this->Produk_model->update($id, $this->_post_data());
        $this->session->set_flashdata('success', 'Produk berhasil diperbarui.');
        redirect('produk');
    }

    public function hapus($id)
    {
        $this->Produk_model->delete($id);
        $this->session->set_flashdata('success', 'Produk berhasil dihapus.');
        redirect('produk');
    }

    private function _rules($id = NULL)
    {
        $unique = '|is_unique[produk.kode_produk]';
        if ($id) {
            $produk = $this->Produk_model->get_by_id($id);
            $kode_lama = $produk ? $produk->kode_produk : '';
            if ($this->input->post('kode_produk', TRUE) === $kode_lama) {
                $unique = '';
            }
        }

        $this->form_validation->set_rules('kode_produk', 'Kode Produk', 'required|trim' . $unique);
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('harga_beli', 'Harga Beli', 'required|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('harga_jual', 'Harga Jual', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('stok', 'Stok', 'required|integer|greater_than_equal_to[0]');
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required|integer');
    }

    private function _post_data()
    {
        return [
            'kode_produk'  => $this->input->post('kode_produk', TRUE),
            'nama_produk'  => $this->input->post('nama_produk', TRUE),
            'harga_beli'   => $this->input->post('harga_beli', TRUE),
            'harga_jual'   => $this->input->post('harga_jual', TRUE),
            'stok'         => $this->input->post('stok', TRUE),
            'id_kategori'  => $this->input->post('id_kategori', TRUE)
        ];
    }
}
