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
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'persyaratan' => 'required|string',
        'alur_layanan' => 'required|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = [
        'nama' => $validated['nama'],
        'deskripsi' => $validated['deskripsi'],
        'persyaratan' => $validated['persyaratan'],
        'alur_layanan' => $validated['alur_layanan'],
    ];

    if ($request->hasFile('image')) {
        $imageName = time() . '_' .
            $request->file('image')->getClientOriginalName();

        $request->file('image')->move(
            public_path('images'),
            $imageName
        );

        $data['image'] = $imageName;
    }

    Perizinan::create($data);

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
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'persyaratan' => 'required|string',
        'alur_layanan' => 'required|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $perizinan = Perizinan::findOrFail($id);

    $data = [
        'nama' => $validated['nama'],
        'deskripsi' => $validated['deskripsi'],
        'persyaratan' => $validated['persyaratan'],
        'alur_layanan' => $validated['alur_layanan'],
    ];

    if ($request->hasFile('image')) {
        $imageName = time() . '_' .
            $request->file('image')->getClientOriginalName();

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