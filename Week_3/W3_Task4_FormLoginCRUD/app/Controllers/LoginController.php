<?php

namespace App\Controllers;

use App\Models\UserModel;

class LoginController extends BaseController
{
    public function index()
    {
        return view('login_view');
    }

    public function process()
    {
        $session = session();
        $model = new UserModel();
        
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $user = $model->where('username', $username)->first();

        if ($user) {
            // verifikasi password
            if (password_verify($password, $user['password'])) {
                // Buat session
                $session->set([
                    'username' => $user['username'],
                    'isLoggedIn' => TRUE
                ]);
                return redirect()->to('/home'); // Arahkan ke halaman mahasiswa
            }
        }
        
        // Jika username atau password salah
        $session->setFlashdata('msg', 'Username atau Password Salah');
        return redirect()->to('/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}