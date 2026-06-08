<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect('auth');
        }
        $this->load->model('Kategori_model');
    }

    public function index()
    {
        $data['judul'] = 'Kategori';
        $data['kategori'] = $this->Kategori_model->get_all();
        $this->load->view('kategori/index', $data);
    }

    public function tambah()
    {
        $this->_rules();

        if ($this->form_validation->run() === FALSE) {
            $data['judul'] = 'Tambah Kategori';
            $this->load->view('kategori/tambah', $data);
            return;
        }

        $this->Kategori_model->insert([
            'nama_kategori' => $this->input->post('nama_kategori', TRUE)
        ]);
        $this->session->set_flashdata('success', 'Kategori berhasil ditambahkan.');
        redirect('kategori');
    }

    public function edit($id)
    {
        $data['kategori'] = $this->Kategori_model->get_by_id($id);
        if (!$data['kategori']) {
            show_404();
        }

        $this->_rules();
        if ($this->form_validation->run() === FALSE) {
            $data['judul'] = 'Edit Kategori';
            $this->load->view('kategori/edit', $data);
            return;
        }

        $this->Kategori_model->update($id, [
            'nama_kategori' => $this->input->post('nama_kategori', TRUE)
        ]);
        $this->session->set_flashdata('success', 'Kategori berhasil diperbarui.');
        redirect('kategori');
    }

    public function hapus($id)
    {
        $this->Kategori_model->delete($id);
        $this->session->set_flashdata('success', 'Kategori berhasil dihapus. Produk terkait tetap aman.');
        redirect('kategori');
    }

    private function _rules()
    {
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|trim|min_length[3]');
    }
}
