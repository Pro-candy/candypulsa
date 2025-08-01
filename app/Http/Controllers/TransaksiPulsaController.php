<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Operator;

class TransaksiPulsaController extends Controller
{
    public function cariProduk(Request $request)
    {
        $nomor = preg_replace('/\D/', '', $request->nomor_hp);
        $menu = $request->menu ?? 'Pulsa';
        $menuLower = strtolower($menu);

        $minDigits = [
            'pulsa' => 9,
            'data' => 9,
            'token pln' => 9,
            'ewallet' => 9,
            'sms/tlp' => 9,
            'game' => 5,
        ];

        $minLength = $minDigits[$menuLower] ?? 9;
        if (strlen($nomor) < $minLength) {
            return response()->json(['success' => false]);
        }

        $operators = Operator::where('aktif', 'yes')
            ->where('menu', $menu)
            ->whereNotNull('prefix_tujuan')
            ->get();

        $prefixMatchedOperators = [];

        foreach ($operators as $op) {
            foreach (explode(',', $op->prefix_tujuan) as $prefix) {
                $prefix = trim($prefix);
                if ($prefix !== '') {
                    if (!isset($prefixMatchedOperators[$prefix])) {
                        $prefixMatchedOperators[$prefix] = [];
                    }
                    $prefixMatchedOperators[$prefix][] = $op;
                }
            }
        }

        // Urutkan prefix dari terpanjang ke terpendek
        uksort($prefixMatchedOperators, fn($a, $b) => strlen($b) <=> strlen($a));

        $matchedOperators = [];

        foreach ($prefixMatchedOperators as $prefix => $ops) {
            // 🔧 Untuk Game, cocokkan hanya 1 digit awal
            if ($menuLower === 'game') {
                if (substr($nomor, 0, 1) === substr($prefix, 0, 1)) {
                    foreach ($ops as $op) {
                        if (!isset($matchedOperators[$op->kode])) {
                            $matchedOperators[$op->kode] = $op;
                        }
                    }
                }
            } else {
                // Menu lain: cocokkan prefix penuh
                if (substr($nomor, 0, strlen($prefix)) === $prefix) {
                    foreach ($ops as $op) {
                        if (!isset($matchedOperators[$op->kode])) {
                            $matchedOperators[$op->kode] = $op;
                        }
                    }
                }
            }
        }

        if (empty($matchedOperators)) {
            return response()->json(['success' => false]);
        }

        $operatorList = [];

        foreach ($matchedOperators as $op) {
            $produkList = Produk::where('kode_operator', $op->kode)
                ->where('aktif', 'yes')
                ->orderBy('harga_jual')
                ->get()
                ->map(function ($p) use ($op) {
                    return [
                        'id' => $p->kode,
                        'nama' => $p->nama,
                        'harga' => $p->harga_jual,
                        'gambar' => $op->link_gambar
                    ];
                })->toArray();

            if (!empty($produkList)) {
                $operatorList[] = [
                    'kode' => $op->kode,
                    'nama' => $op->nama,
                    'head_property' => $op->head_property ?? 'card-primary',
                    'prioritas' => $op->prioritas ?? 999,
                    'produk' => $produkList
                ];
            }
        }

        // Urutkan berdasarkan prioritas
        usort($operatorList, fn($a, $b) => $a['prioritas'] <=> $b['prioritas']);

        return response()->json([
            'success' => true,
            'operators' => $operatorList
        ]);
    }



}
