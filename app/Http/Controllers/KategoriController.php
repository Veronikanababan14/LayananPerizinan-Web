<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use App\Models\Aktivitas;

class KategoriController extends Controller
{
    // Menampilkan daftar kategori
    public function index()
    {
        $kategoris = Kategori::all();
        return view('admin.kategori.index', compact('kategoris'));
    }

    // Form tambah kategori
    public function create()
    {
        return view('admin.kategori.create');
    }

    // Simpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal'   => 'nullable|date',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('kategori', 'public');
        }

        Kategori::create([
            'nama'      => $request->nama,
            'deskripsi' => $request->deskripsi,
            'image'     => $imagePath,
            'tanggal'   => $request->tanggal,
        ]);

        Aktivitas::create([
        'aksi' => 'Admin menambahkan Perizinan: ' . $request->nama,
    ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Perizinan berhasil ditambahkan!');
    }

    // Form edit kategori
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    // Update kategori
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal'   => 'nullable|date',
        ]);

        $kategori = Kategori::findOrFail($id);

        // Jika upload gambar baru, hapus gambar lama
        if ($request->hasFile('image')) {
            if ($kategori->image && Storage::disk('public')->exists($kategori->image)) {
                Storage::disk('public')->delete($kategori->image);
            }
            $imagePath = $request->file('image')->store('kategori', 'public');
            $kategori->image = $imagePath;
        }

        // Update data lainnya
        $kategori->update([
            'nama'      => $request->nama,
            'deskripsi' => $request->deskripsi,
            'tanggal'   => $request->tanggal,
            'image'     => $kategori->image ?? null,
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Perizinan berhasil diupdate!');
    }

    // Hapus kategori
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);

       Aktivitas::create([
        'aksi' => 'Admin menghapus perizinan: ' . $kategori->nama,
    ]);
        
        $kategori->delete();

        return redirect()->route('admin.kategori.index')->with('success', 'Perizinan berhasil dihapus!');
    }
}
