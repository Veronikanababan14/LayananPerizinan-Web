<?php

namespace App\Http\Controllers;

use App\Models\Iuk;
use Illuminate\Http\Request;

class IukController extends Controller
{
    public function index()
    {
        $iuks = Iuk::all();
        return view('admin.iuk.index', compact('iuks'));
    }

    public function create()
    {
        return view('admin.iuk.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'judul' => 'required',
        'deskripsi' => 'required',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $data = $request->all();

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('iuk', 'public');
    }

    Iuk::create($data);

    return redirect()->route('admin.iuk.index')
        ->with('success', 'Data berhasil ditambahkan');
}

    public function edit($id)
    {
        $iuk = Iuk::findOrFail($id);
        return view('admin.iuk.edit', compact('iuk'));
    }

    public function update(Request $request, $id)
{
    $iuk = Iuk::findOrFail($id);

    $request->validate([
        'judul' => 'required',
        'deskripsi' => 'required',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $data = $request->all();

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('iuk', 'public');
    }

    $iuk->update($data);

    return redirect()->route('admin.iuk.index')
        ->with('success', 'Data berhasil diupdate');
}

    public function destroy($id)
    {
        Iuk::destroy($id);

        return redirect()->route('admin.iuk.index')
            ->with('success', 'Data berhasil dihapus');
    }
}