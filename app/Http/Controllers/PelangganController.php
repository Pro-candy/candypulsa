<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PelangganTokoReseller;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $resellerId = Auth::guard('reseller')->id();
        $query = PelangganTokoReseller::where('reseller_id', $resellerId);

        if ($request->q) {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->q . '%')
                  ->orWhere('phone', 'like', '%' . $request->q . '%');
            });
        }

        $pelanggan = $query->orderBy('nama')->paginate(10);

        return view('member-area.pelanggan.index', compact('pelanggan'));
    }

    // Form untuk modal
    public function create()
    {
        return view('member-area.pelanggan._form');
    }

    // Simpan pelanggan baru
    public function store(Request $request)
    {
        // Ambil reseller yang sedang login
        $reseller = Auth::guard('reseller')->user();

        if (!$reseller || !$reseller->kode) {
            return response()->json(['success' => false, 'message' => 'Reseller tidak ditemukan atau kode reseller kosong'], 401);
        }

        $request->validate([
            'nama' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:100',
        ]);

        // Generate kode pelanggan unik
        $kode = Helper::generateKodePelanggan($reseller->kode, $request->nama);

        try {
            $pelanggan = PelangganTokoReseller::create([
                'reseller_id'   => $reseller->id,
                'kode_pelanggan'=> $kode,
                'nama'          => $request->nama,
                'phone'         => $request->phone,
                'alamat'        => $request->alamat,
                'email'         => $request->email,
                'info_tambahan' => $request->info_tambahan,
            ]);

            return response()->json(['success' => true, 'message' => 'Pelanggan berhasil ditambahkan', 'data' => $pelanggan]);
        } catch (\Exception $e) {
            // Tangani error (misal: duplikat kode, dsb)
            return response()->json(['success' => false, 'message' => 'Gagal menambah pelanggan: ' . $e->getMessage()], 500);
        }
    }
    public function autocomplete(Request $request)
    {
        $search = $request->get('q', '');

        // Ambil reseller_id dari session login
        $resellerId = Auth::guard('reseller')->id();

        if (!$resellerId) {
            return response()->json([]);
        }

        $pelanggan = PelangganTokoReseller::select('id', 'kode_pelanggan', 'nama')
            ->where('reseller_id', $resellerId)
            ->where(function ($q) use ($search) {
                $q->where('kode_pelanggan', 'LIKE', "%$search%")
                ->orWhere('nama', 'LIKE', "%$search%");
            })
            ->limit(10)
            ->get();

        $results = $pelanggan->map(function ($p) {
            return [
                'id' => $p->id,
                'kode' => $p->kode_pelanggan,
                'nama' => $p->nama,
                'text' => "{$p->kode_pelanggan} - {$p->nama}",
            ];
        });

        return response()->json($results);
    }


}