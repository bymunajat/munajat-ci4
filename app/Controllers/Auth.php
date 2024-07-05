<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function processLogin()
    {
        // Validasi input dari form login
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Ambil data dari form login
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Cek ke database untuk validasi pengguna
        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Login gagal. Periksa kembali username dan password Anda.');
        }

        // Simpan data pengguna ke session jika login berhasil
        $session = session();
        $session->set('user_id', $user['id']);
        $session->set('username', $user['username']);

        // Redirect ke halaman dashboard atau halaman setelah login
        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        $session = session();
        $session->remove(['user_id', 'username']);
        return redirect()->to('/login');
    }
}
