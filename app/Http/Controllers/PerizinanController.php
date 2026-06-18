<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perizinan;
use App\Models\Iuk;

class PerizinanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DASHBOARD USER
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        // layanan perizinan
        $perizinans = Perizinan::take(4)->get();

        return view('user.dashboard', compact(
            'perizinans',
            
        ));
    }
    public function adminIndex()
{
    $perizinans = Perizinan::all();

    return view(
        'admin.perizinan.index',
        compact('perizinans')
    );
}

    /*
    |--------------------------------------------------------------------------
    | DETAIL PERIZINAN
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $perizinan = Perizinan::findOrFail($id);

        return view('perizinan.show', compact('perizinan'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORM PENGAJUAN IZIN
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        $perizinans = Perizinan::all();

        return view('user.form-izin', compact('perizinans'));
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN PENGAJUAN
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pemohon' => 'required',
            'jenis_izin' => 'required',
            'dokumen' => 'required|file'
        ]);

        $file = $request->file('dokumen')->store('dokumen', 'public');

        Iuk::create([
            'nama_pemohon' => $request->nama_pemohon,
            'jenis_izin' => $request->jenis_izin,
            'dokumen' => $file,
            'status' => 'Menunggu Verifikasi'
        ]);

        return redirect()->back()->with(
            'success',
            'Pengajuan izin berhasil dikirim'
        );
    }
    // ================= ADMIN =================

public function createAdmin()
{
    return view('admin.perizinan.create');
}

public function storeAdmin(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'deskripsi' => 'required',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $imageName = null;

    if ($request->hasFile('image')) {

        $imageName = time().'_'.$request->file('image')->getClientOriginalName();

        $request->file('image')->move(
            public_path('images'),
            $imageName
        );
    }

    Perizinan::create([
        'nama' => $request->nama,
        'deskripsi' => $request->deskripsi,
        'image' => $imageName
    ]);

    return redirect()
        ->route('admin.perizinan.index')
        ->with('success', 'Data berhasil ditambahkan');
}

public function editAdmin($id)
{
    $perizinan = Perizinan::findOrFail($id);

    return view(
        'admin.perizinan.edit',
        compact('perizinan')
    );
}

public function updateAdmin(Request $request, $id)
{
    $request->validate([
        'nama' => 'required',
        'deskripsi' => 'required',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $perizinan = Perizinan::findOrFail($id);

    $data = [
        'nama' => $request->nama,
        'deskripsi' => $request->deskripsi
    ];

    if ($request->hasFile('image')) {

        $imageName = time().'_'.$request->file('image')->getClientOriginalName();

        $request->file('image')->move(
            public_path('images'),
            $imageName
        );

        $data['image'] = $imageName;
    }

    $perizinan->update($data);

    return redirect()
        ->route('admin.perizinan.edit', $id)
        ->with('success', 'Data berhasil diupdate');
}

public function destroyAdmin($id)
{
    $perizinan = Perizinan::findOrFail($id);

    $perizinan->delete();

    return redirect()
        ->route('admin.perizinan.index')
        ->with('success', 'Data berhasil dihapus');
}
        /*
    |--------------------------------------------------------------------------
    | SEARCH PERIZINAN
    |--------------------------------------------------------------------------
    */
    public function search(Request $request)
{
    $search = $request->search;

    $perizinans = Perizinan::where(
        'nama',
        'LIKE',
        "%{$search}%"
    )
    ->orWhere(
        'deskripsi',
        'LIKE',
        "%{$search}%"
    )
    ->get();

    return view(
        'perizinan.search',
        compact(
            'perizinans',
            'search'
        )
    );
}
}