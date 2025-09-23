<?php

namespace App\Controllers;

use App\Models\UserModel;

class LoginController extends BaseController
{
    public function index()
    {
        // Jika sudah login, lempar ke halaman home
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/home');
        }
        return view('login_view');
    }

    public function process()
    {
        $session = session();
        $model = new UserModel();
        
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $user = $model->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            // Jika verifikasi berhasil, buat session
            $session->set([
                'user_id'    => $user['id'],
                'username'   => $user['username'],
                'full_name'  => $user['full_name'],
                'role'       => $user['role'],
                'isLoggedIn' => true
            ]);
            return redirect()->to('/home');
        } 
        
        // Jika username atau password salah
        $session->setFlashdata('error', 'Username atau Password Salah');
        return redirect()->to('/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}