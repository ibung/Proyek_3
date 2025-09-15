<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {

        $data = [
            'title' => 'Home',
            'content' => view('welcome')

        ];

        return view('template', $data);
    }
}
