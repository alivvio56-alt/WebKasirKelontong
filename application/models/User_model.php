<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    // Ambil data user berdasarkan username
    public function cek_login($username)
    {
        return $this->db
            ->where('username', $username)
            ->get('users')
            ->row();
    }

    // Tambah user baru dengan password di-hash
    public function tambah_user($nama, $username, $password, $role = 'kasir')
    {
        $data = [
            'nama'     => $nama,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role'     => $role
        ];

        return $this->db->insert('users', $data);
    }

    // Update password user (opsional)
    public function update_password($id_user, $password_baru)
    {
        $data = [
            'password' => password_hash($password_baru, PASSWORD_DEFAULT)
        ];

        $this->db->where('id', $id_user);
        return $this->db->update('users', $data);
    }
}