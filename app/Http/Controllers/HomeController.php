<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;
use App\Models\Perizinan;
use App\Models\Iuk;

class HomeController extends Controller
{
    public function index()
    {
        $layanans = Layanan::all();
        $perizinans = Perizinan::all();
        $iuks = Iuk::all();

        return redirect()->route('dashboard.user');
    }
}