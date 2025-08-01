<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;
use App\Models\PengumumanRead;

class PengumumanController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->guard('reseller')->id();
        $q = $request->input('q');

        $pengumuman = Pengumuman::where('status', 'active')
            ->when($q, function($query) use ($q) {
                $query->where(function($sub) use ($q) {
                    $sub->where('judul', 'like', '%'.$q.'%')
                        ->orWhere('isi', 'like', '%'.$q.'%');
                });
            })
            ->where(function($q){
                $now = now();
                $q->whereNull('mulai')->orWhere('mulai', '<=', $now);
            })
            ->where(function($q){
                $now = now();
                $q->whereNull('berakhir')->orWhere('berakhir', '>=', $now);
            })
            ->orderBy('prioritas', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Tandai semua pengumuman di halaman ini sebagai sudah dibaca
        $pengumumanIds = $pengumuman->pluck('id')->toArray();
        if (!empty($pengumumanIds)) {
            $alreadyRead = PengumumanRead::where('reseller_id', $userId)
                ->whereIn('pengumuman_id', $pengumumanIds)
                ->pluck('pengumuman_id')
                ->toArray();

            $toInsert = array_diff($pengumumanIds, $alreadyRead);

            foreach ($toInsert as $pid) {
                PengumumanRead::create([
                    'pengumuman_id' => $pid,
                    'reseller_id' => $userId,
                    'read_at' => now()
                ]);
            }
        }

        $readIds = PengumumanRead::where('reseller_id', $userId)->pluck('pengumuman_id')->toArray();

        if ($request->ajax()) {
            // Kembalikan bagian table saja
            return view('member-area.pengumuman.index', compact('pengumuman', 'readIds'))->renderSections()['content'];
        }

        return view('member-area.pengumuman.index', compact('pengumuman', 'readIds'));
    }

    public function show($id)
    {
        $userId = auth()->guard('reseller')->id();
        $item = Pengumuman::findOrFail($id);

        // Tandai sudah dibaca
        PengumumanRead::firstOrCreate([
            'pengumuman_id' => $id,
            'reseller_id' => $userId
        ], [
            'read_at' => now()
        ]);

        // Untuk AJAX modal, return partial
        if (request()->ajax()) {
            return view('member-area.pengumuman._detail', compact('item'));
        }

        return view('member-area.pengumuman.show', compact('item'));
    }
}