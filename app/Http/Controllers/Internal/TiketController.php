<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\TiketDeposit;
use App\Models\parameter;
use Carbon\Carbon;
use App\Helpers\Helper;

class TiketController extends Controller
{
    public static function generate($reseller, $jumlah)
    {
        if ($jumlah < 50000) {
            return [
                'status' => 'error',
                'message' => 'Tiket minimal 50.000'
            ];
        }

        // Ambil semua tiket open dari reseller
        $tiketOpen = TiketDeposit::where('reseller_id', $reseller->id)
                        ->where('status', 'open')
                        ->orderBy('created_at', 'asc')
                        ->get();

        // 1. Cek jika jumlah sama sudah ada
        $tiketSama = $tiketOpen->firstWhere('jumlah', $jumlah);
        if ($tiketSama) {
            $template = Helper::param('jawaban', 'tiket_nominal_sama', 'Anda masih punya tiket yang masih open, silahkan transfer [jumlahtiket] ke rekening');
            $message = str_replace('[jumlahtiket]', number_format($tiketSama->jumlah, 0, ',', '.'), $template);
            return [
                'status' => 'info',
                'message' => $message
            ];
        }

        // 2. Cek jika sudah ada 3 tiket open
        if ($tiketOpen->count() >= 3) {
            $template = Helper::param('jawaban', 'tiket_open_max', 'Anda masih punya 3 tiket open, silahkan transfer [jumlahtiket1]/[jumlahtiket2]/[jumlahtiket3] ke rekening');
            $jumlahList = $tiketOpen->take(3)->pluck('jumlah')->map(function ($j) {
                return number_format($j, 0, ',', '.');
            })->values();

            $message = str_replace(
                ['[jumlahtiket1]', '[jumlahtiket2]', '[jumlahtiket3]'],
                [$jumlahList[0] ?? '', $jumlahList[1] ?? '', $jumlahList[2] ?? ''],
                $template
            );

            return [
                'status' => 'info',
                'message' => $message
            ];
        }

        // 3. Buat tiket baru
        // 3. Buat tiket baru dengan jumlah unik
            $jumlahUnik = $jumlah + rand(101, 1999);
            $kodeTiket = 'TIKET-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(4));

            $tiket = TiketDeposit::create([
                'kode_tiket' => $kodeTiket,
                'reseller_id' => $reseller->id,
                'jumlah' => $jumlahUnik,
                'tgl_ambil_tiket' => now(),
                'status' => 'open',
                'kode_bank' => null,
            ]);

            $template = Helper::param('jawaban', 'tiket_balasan', 'silahkan transfer [jumlahtiket]');
            $message = str_replace('[jumlahtiket]', number_format($jumlahUnik, 0, ',', '.'), $template);

            return [
                'status' => 'success',
                'kode_tiket' => $kodeTiket,
                'jumlah' => $jumlahUnik,
                'message' => $message
            ];
    }
}
