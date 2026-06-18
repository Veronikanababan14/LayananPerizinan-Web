<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;

class LayananController extends Controller
{
    // ================= USER =================

    public function index()
    {
        $layanans = Layanan::all();
        return view('layanan.index', compact('layanans'));
    }

    public function adminIndex()
    {
        $layanans = Layanan::all();

        return view('admin.iuk.index', compact('layanans'));
    }

    public function show($id)
    {
        $layanan = Layanan::findOrFail($id);

        return view('layanan.show', compact('layanan'));
    }

    // ================= ADMIN =================

    public function create()
    {
        return view('admin.iuk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $namaFile = null;

        if ($request->hasFile('image')) {

            $namaFile = time() . '_' .
                $request->file('image')->getClientOriginalName();

            $request->file('image')->move(
                public_path('images'),
                $namaFile
            );
        }

        Layanan::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'image' => $namaFile
        ]);

        return redirect()
            ->route('admin.iuk.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $layanan = Layanan::findOrFail($id);

        return view('admin.iuk.edit', compact('layanan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $layanan = Layanan::findOrFail($id);

        $data = [
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi
        ];

        if ($request->hasFile('image')) {

            $namaFile = time() . '_' .
                $request->file('image')->getClientOriginalName();

            $request->file('image')->move(
                public_path('images'),
                $namaFile
            );

            $data['image'] = $namaFile;
        }

        $layanan->update($data);

        return redirect()->back()
    ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);

        $layanan->delete();

        return redirect()
            ->route('admin.iuk.index')
            ->with('success', 'Data berhasil dihapus');
    }

    // ================= SEARCH =================

    public function search(Request $request)
{
    $query = trim($request->input('q'));

    // Cari di layanan
    $layanans = Layanan::where('nama', 'LIKE', "%{$query}%")
        ->orWhere('deskripsi', 'LIKE', "%{$query}%")
        ->get();

    // Cari di perizinan
    $perizinans = \App\Models\Perizinan::where('nama', 'LIKE', "%{$query}%")
        ->orWhere('deskripsi', 'LIKE', "%{$query}%")
        ->get();

    // Jika ditemukan 1 layanan
    if ($layanans->count() == 1 && $perizinans->count() == 0) {
        return redirect()->route(
            'layanan.show',
            $layanans->first()->id
        );
    }

    // Jika ditemukan 1 perizinan
    if ($perizinans->count() == 1 && $layanans->count() == 0) {
        return redirect()->route(
            'perizinan.show',
            $perizinans->first()->id
        );
    }

    return view(
        'search-result',
        compact(
            'layanans',
            'perizinans',
            'query'
        )
    );
}
    public function dashboardSearch(Request $request)
{
    $keyword = $request->keyword;

    $layanans = Layanan::where('nama', 'LIKE', "%{$keyword}%")
        ->orWhere('deskripsi', 'LIKE', "%{$keyword}%")
        ->get()
        ->map(function ($item) {
            return [
                'id' => $item->id,
                'nama' => $item->nama,
                'jenis' => 'layanan'
            ];
        });

    $perizinans = \App\Models\Perizinan::where('nama', 'LIKE', "%{$keyword}%")
        ->orWhere('deskripsi', 'LIKE', "%{$keyword}%")
        ->get()
        ->map(function ($item) {
            return [
                'id' => $item->id,
                'nama' => $item->nama,
                'jenis' => 'perizinan'
            ];
        });

    return response()->json(
        $layanans->concat($perizinans)->values()
    );
}
}