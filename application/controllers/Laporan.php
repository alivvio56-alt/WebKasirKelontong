<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect('auth');
        }
        $this->load->model('Transaksi_model');
    }

    public function index()
    {
        $tanggal_mulai = $this->input->get('tanggal_mulai', TRUE) ?: date('Y-m-01');
        $tanggal_selesai = $this->input->get('tanggal_selesai', TRUE) ?: date('Y-m-d');

        $data['judul'] = 'Laporan Penjualan';
        $data['tanggal_mulai'] = $tanggal_mulai;
        $data['tanggal_selesai'] = $tanggal_selesai;
        $data['laporan'] = $this->Transaksi_model->get_laporan($tanggal_mulai, $tanggal_selesai);
        $data['total_pendapatan'] = $this->Transaksi_model->total_laporan($tanggal_mulai, $tanggal_selesai);

        $this->load->view('laporan/index', $data);
    }
}
