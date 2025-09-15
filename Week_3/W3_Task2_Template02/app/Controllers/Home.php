<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Home - Website SMA XYZ'
        ];
        
        return view('home_view', $data);
    }
}