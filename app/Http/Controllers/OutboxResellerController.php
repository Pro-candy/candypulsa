<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OutboxReseller;

class OutboxResellerController extends Controller
{
    // Tampilkan daftar pesan untuk reseller
    public function index(Request $request)
    {
        $userKode = auth()->guard('reseller')->user()->kode;
        $q = $request->input('q');
        $outbox = OutboxReseller::where('reseller_kode', $userKode)
            ->when($q, function($query) use ($q) {
                $query->where(function($sub) use ($q) {
                    $sub->where('keterangan', 'like', '%'.$q.'%')
                        ->orWhere('pesan', 'like', '%'.$q.'%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            // Kembalikan hanya isi table (bukan layout)
            return response()->view('member-area.inbox_reseller._table_inner', compact('outbox'));
        }

        return view('member-area.inbox_reseller.index', compact('outbox'));
    }

    // Tandai semua pesan sudah dibaca
    public function markAllRead()
    {
        $userKode = auth()->guard('reseller')->user()->kode;
        OutboxReseller::where('reseller_kode', $userKode)
            ->where('read', 'no')
            ->update(['read' => 'yes']);

        return redirect()->route('inbox-reseller.index')->with('success', 'Semua pesan ditandai sudah dibaca.');
    }

    // Tampilkan detail pesan (by id)
    public function show($id)
    {
        $userKode = auth()->guard('reseller')->user()->kode;
        $pesan = OutboxReseller::where('reseller_kode', $userKode)->findOrFail($id);

        if ($pesan->read === 'no') {
            $pesan->read = 'yes';
            $pesan->save();
        }

        // Untuk AJAX modal, return partial
        if (request()->ajax()) {
            return view('member-area.inbox_reseller._detail', compact('pesan'));
        }

        return view('member-area.inbox_reseller.show', compact('pesan'));
    }

}