<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reseller;
use App\Models\Pengirim;

class ResellerController extends Controller
{
    public function index(Request $request)
    {
        $query = Reseller::query();

        if ($search = $request->q) {
            $query->where('kode', 'like', "%$search%")
                  ->orWhere('nama', 'like', "%$search%");
        }

        $resellers = $query->orderBy('nama')->paginate(10);

        return view('admin.reseller.index', compact('resellers'));
    }

    public function edit($id)
    {
        // Akan diisi nanti
    }

    public function pengirim($kode)
    {
        $reseller = Reseller::where('kode', $kode)->firstOrFail();

        $pengirimList = Pengirim::where('kode_reseller', $kode)->get();

        $lastUpdate = Pengirim::where('kode_reseller', $kode)
                        ->orderByDesc('updated_at')
                        ->first();

        return view('admin.reseller._modal_pengirim', compact('reseller', 'pengirimList', 'lastUpdate'));
    }


public function simpanPengirim(Request $request)
{
    try {
        $data = $request->all();

        foreach ($data['pengirim'] as $i => $pengirim) {
            if (trim($pengirim) === '') {
                continue;
            }

            \DB::table('pengirim')->insert([
                'kode_reseller' => $data['kode_reseller'],
                'pengirim' => $pengirim,
                'tipe_pengirim' => $data['tipe_pengirim'][$i],
                'kirim_info' => isset($data['kirim_info'][$i]) ? 1 : 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return response()->json(['message' => 'Data berhasil disimpan.']);

    } catch (\Throwable $e) {
        \Log::error('Gagal simpan pengirim: ' . $e->getMessage());
        return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data.'], 500);
    }
}



}
