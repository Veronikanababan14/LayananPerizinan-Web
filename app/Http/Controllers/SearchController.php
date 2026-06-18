<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;
use App\Models\Perizinan;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        $layanans = Layanan::where('nama', 'LIKE', "%{$query}%")->get();
        $perizinans = Perizinan::where('nama', 'LIKE', "%{$query}%")->get();

        return view('layanan.search-result', compact('query', 'layanans', 'perizinans'));
    }
}


