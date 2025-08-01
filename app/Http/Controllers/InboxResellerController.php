<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InboxReseller;

class InboxResellerController extends Controller
{ 
    // Tampilkan daftar pesan masuk
    public function index(Request $request)
    {
        $user = auth()->guard('reseller')->user();
        $q = $request->input('q');
        $outbox  = InboxReseller::where('reseller_kode', $user->kode)
            ->when($q, function($query) use ($q) {
                $query->where(function($sub) use ($q) {
                    $sub->where('pesan', 'like', '%'.$q.'%')
                        ->orWhere('kode_produk', 'like', '%'.$q.'%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            return response()->view('member-area.outbox_reseller._table_inner', compact('outbox'));
        }

        return view('member-area.outbox_reseller.index', compact('outbox'));
    }

    // Tampilkan detail pesan
    public function show($id)
    {
        $user = auth()->guard('reseller')->user();
        $pesan = InboxReseller::where('reseller_kode', $user->kode)->findOrFail($id);

        // Untuk AJAX modal, return partial
        if (request()->ajax()) {
            return view('member-area.outbox_reseller._detail', compact('pesan'));
        }

        return view('member-area.outbox_reseller.show', compact('pesan'));
    }
}