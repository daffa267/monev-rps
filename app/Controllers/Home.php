<?php

namespace App\Controllers;

class Home extends BaseController
{
    // public function index(): string
    // {
    //     return view('welcome_message');
    // }

    public function index()
    {
        // Cek apakah pengguna sudah login
        if (service('authentication')->check()) {
            // Ambil data pengguna yang sedang login
            $user = service('authentication')->user();

            // Cek grup pengguna dan redirect ke dashboard sesuai grup
            if ($user->inGroup('dosen')) {
                return redirect()->to('/dashboard/dashboard_dosen');
            } elseif ($user->inGroup('gpm')) {
                return redirect()->to('/dashboard/dashboard_gpm');
            } elseif ($user->inGroup('admin')) {
                return redirect()->to('/dashboard/dashboard_admin');
            } elseif ($user->inGroup('kajur')) {
                return redirect()->to('/dashboard/dashboard_kajur');
            } else {
                // Jika pengguna tidak punya grup sesuai, arahkan ke halaman default
                return redirect()->to('/default_dashboard');
            }
            
        }
        // Jika pengguna belum login, arahkan ke halaman login
        return redirect()->to('/login');
    }
}
