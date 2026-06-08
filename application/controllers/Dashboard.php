<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
        $data['judul'] = 'Dashboard';
        $data['total_produk'] = $this->Produk_model->count_all();
        $data['stok_menipis'] = $this->Produk_model->count_stok_menipis();
        $data['transaksi_hari_ini'] = $this->Transaksi_model->count_hari_ini();
        $data['pendapatan_hari_ini'] = $this->Transaksi_model->pendapatan_hari_ini();
        $data['produk_terbaru'] = $this->Produk_model->get_latest(5);
        $data['transaksi_terbaru'] = $this->Transaksi_model->get_latest(5);

        $this->load->view('dashboard/index', $data);
    }
}
