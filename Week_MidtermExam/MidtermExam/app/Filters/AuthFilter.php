<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // 1. Cek apakah user sudah login
        if (!$session->get('isLoggedIn')) {
            // Jika belum, paksa kembali ke halaman login
            return redirect()->to(site_url('login'))->with('error', 'Anda harus login terlebih dahulu.');
        }

        // 2. Cek apakah filter memerlukan role tertentu (misal: 'gudang', 'dapur')
        if (!empty($arguments)) {
            $userRole = $session->get('role');
            // Jika role user tidak ada di dalam daftar role yang diizinkan ($arguments)
            if (!in_array($userRole, $arguments)) {
                // Tampilkan halaman error atau redirect ke halaman lain
                // throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                return redirect()->back()->with('error', 'Anda tidak memiliki hak akses ke halaman ini.');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada aksi setelah request
    }
}