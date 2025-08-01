<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengirim;
use App\Models\Reseller;
use App\Http\Controllers\Internal\TiketController;
use Illuminate\Support\Facades\Hash;
use App\Models\Parameter;
use App\Helpers\Helper;

class ResellerController extends Controller
{
    public function handleRequest(Request $request, $url)
    {
        $ip = $request->ip();
        $payload = http_build_query($request->all());
        $fullMessage = $url . '?' . $payload;

        // Cek pengirim berdasarkan IP dan tipe IP (HTTP)
        $pengirim = Pengirim::where('pengirim', $ip)
                            ->where('tipe_pengirim', 'HTTP')
                            ->first();

        if (!$pengirim) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pesan diterima',
                'pengirim' => $ip,
                'pesan' => $fullMessage,
                'keterangan' => 'Anda bukan member kami, silakan kirim pesan ini ke customer service kami.'
            ]);
        }

        // Validasi URL endpoint berdasarkan parameter.value
        $urlTiket = Helper::param('request', 'url_tiket', 'tiket');
        $urlTrx = Helper::param('request', 'url_transaksi', 'trx');
        $urlSaldo = Helper::param('request', 'url_cek_saldo', 'saldo');

        if (!in_array($url, [$urlTiket, $urlTrx, $urlSaldo])) {
            $msg = Helper::param('jawaban', 'format_url_salah', 'Format URL tidak dikenali.');
            return response()->json([
                'status' => 'error',
                'message' => $msg
            ]);
        }

        // Autentikasi reseller via pengirim.kode_reseller
        $reseller = null;
        if ($pengirim->kode_reseller) {
            $reseller = Reseller::where('kode', $pengirim->kode_reseller)->first();
        }

        if (!$reseller) {
            return response()->json([
                'status' => 'error',
                'message' => 'Reseller tidak ditemukan dari pengirim ini.'
            ]);
        }

        $kodereseller = $request->input('kodereseller');
        $jumlah = $request->input('jumlah');
        $sign = $request->input('sign');
        $pin = $request->input('pin');
        $password = $request->input('password');

        if (!$kodereseller || !$jumlah) {
            return response()->json([
                'status' => 'error',
                'message' => 'parameter tidak lengkap, anda harus memasukkan kodereseller dan jumlah'
            ]);
        }

        if ($sign) {
            $validSign = md5($reseller->pin . '&' . $reseller->password);
            if ($sign !== $validSign) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Signature salah'
                ]);
            }
        } else {
            if (!$pin || !$password) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'parameter tidak lengkap, anda harus memasukkan pin dan password'
                ]);
            }

            if ($reseller->pin !== $pin || !Hash::check($password, $reseller->password)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Pin atau password salah'
                ]);
            }
        }

        // Routing berdasarkan jenis URL
        if ($url === $urlTiket) {
            $response = TiketController::generate($reseller, $jumlah);
            return response()->json($response);
        } elseif ($url === $urlTrx) {
            return response()->json([
                'status' => 'error',
                'message' => 'Fitur transaksi belum tersedia.'
            ]);
        } elseif ($url === $urlSaldo) {
            return response()->json([
                'status' => 'error',
                'message' => 'Fitur cek saldo belum tersedia.'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Terjadi kesalahan sistem.'
        ]);
    }
}
