<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Home - Sistem Informasi Akademik'
        ];
        
        return view('home_view', $data);
    }
}