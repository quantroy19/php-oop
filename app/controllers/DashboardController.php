<?php

namespace App\Controllers;

class DashboardController
{
    public function index()
    {
        return view('home.dashboard', [
            'title' => 'Welcome',
        ]);
    }
}
