<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        // Jika sudah login, redirect ke dashboard
        if ($this->session->userdata('login')) {
            redirect('dashboard');
        }

        // Form validation
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('auth/login');
            return;
        }

        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);

        // Ambil data user berdasarkan username
        $user = $this->User_model->cek_login($username);

        // Cek apakah user ada dan password sesuai
        if ($user) {
            // Password di database diasumsikan sudah di-hash
            if (password_verify($password, $user->password)) {
                $this->session->set_userdata([
                    'login'    => TRUE,
                    'id_user'  => $user->id,
                    'nama'     => $user->nama,
                    'username' => $user->username,
                    'role'     => $user->role
                ]);
                redirect('dashboard');
            }
        }

        // Jika login gagal
        $this->session->set_flashdata('error', 'Username atau password salah.');
        redirect('auth');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}