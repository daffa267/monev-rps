<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function dosen()
    {
        return view('dashboard/dashboard_Dosen');
    }
    public function gpm()
    {
        return view('dashboard/dashboard_gpm');
    }
    public function admin()
    {
        return view('dashboard/dashboard_admin');
    }
    public function kajur()
    {
        return view('dashboard/dashboard_kajur');
    }
}
