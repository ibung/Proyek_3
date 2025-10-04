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

        // mengambil email dan password dari form login
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        // mencari pengguna dari email
        $user = $model->where('email', $email)->first();

        // hashed
        if ($user && md5($password) === $user['password']) {
            
            // buat session
            $sessionData = [
                'user_id'    => $user['id'],
                'name'       => $user['name'],
                'email'      => $user['email'],
                'role'       => $user['role'],
                'isLoggedIn' => true
            ];
            $session->set($sessionData);

            // ke dashboard sesuai role
            if ($user['role'] === 'gudang') {
                return redirect()->to(site_url('gudang/dashboard'));
            } else {
                return redirect()->to(site_url('dapur/dashboard'));
            }
        }

        // email atau password salah
        $session->setFlashdata('error', 'Email atau Password yang Anda masukkan salah.');
        return redirect()->to('login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}