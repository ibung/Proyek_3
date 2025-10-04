<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    // Alias untuk filter agar lebih mudah dipanggil
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'auth'          => \App\Filters\AuthFilter::class, // Filter untuk halaman yang butuh login
    ];

    // Filter global yang dijalankan di setiap request
    public array $globals = [
        'before' => [
            // 'honeypot',
            // 'csrf',
        ],
        'after' => [
            'toolbar', // Selalu tampilkan debug toolbar
            // 'honeypot',
        ],
    ];

    // Tidak ada filter spesifik per method
    public array $methods = [];

    // Tidak ada filter spesifik (sudah di-handle di Routes.php)
    public array $filters = [];
}