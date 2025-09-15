<?php

namespace App\Controllers;

use App\Models\UserModel;

class RegisterController extends BaseController
{
    public function index()
    {
        // tampilin form register
        return view('register_view');
    }

    public function save()
    {
        $model = new UserModel();

        // ambil input dari form
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        // hash password sebelum disimpan
        $data = [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];

        // simpan ke database
        $model->save($data);

        // redirect ke halaman login
        return redirect()->to('/login')->with('msg', 'Registrasi berhasil, silakan login!');
    }
}
