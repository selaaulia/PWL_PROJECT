<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role = Auth::user()->role;
        if ($role == "admin") {
            return redirect()->to('/admin');
        } else if ($role == "petugas") {
            return redirect()->to('/petugas');
        } else if ($role == "anggota") {
            return redirect()->to('/anggota');
        } else {
            return redirect()->to('logout');
        }
    }
}
