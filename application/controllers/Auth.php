<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index()
    {
        if ($this->session->userdata('login')) {
            redirect('dashboard');
        }

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('auth/login');
            return;
        }

        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);
        $user = $this->User_model->cek_login($username);

        if ($user && password_verify($password, $user->password)) {
            $this->session->set_userdata([
                'login'    => TRUE,
                'id_user'  => $user->id,
                'nama'     => $user->nama,
                'username' => $user->username,
                'role'     => $user->role
            ]);

            redirect('dashboard');
        }

        $this->session->set_flashdata('error', 'Username atau password salah.');
        redirect('auth');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
