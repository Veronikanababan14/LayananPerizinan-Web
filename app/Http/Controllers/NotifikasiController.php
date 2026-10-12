<?php
namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function index()
    {
        $notifikasi = Notifikasi::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json($notifikasi);
    }

public function tandaiBaca($id)
{
    Notifikasi::where('id', $id)
        ->where('user_id', Auth::id())
        ->update([
            'dibaca' => true
        ]);

    return response()->json([
        'success' => true
    ]);
}

    public function bacaSemua()
    {
        Notifikasi::where('user_id', Auth::id())
            ->update(['dibaca' => true]);
        return response()->json(['success' => true]);
    }
}