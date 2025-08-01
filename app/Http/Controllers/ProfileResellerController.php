<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reseller;

class ProfileResellerController extends Controller
{
    // Tampilkan form edit profile
    public function index()
    {
        $reseller = auth()->guard('reseller')->user();
        return view('member-area.profile_reseller.index', compact('reseller'));
    }

    // Proses update profile
    public function update(Request $request)
    {
        $reseller = auth()->guard('reseller')->user();

        $validated = $request->validate([
            'nama' => 'required|string|max:50',
            'nama_toko' => 'nullable|string|max:100',
            'nomor_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'link_foto_profile' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('link_foto_profile')) {
            $file = $request->file('link_foto_profile')->store('foto_profile', 'public');
            $validated['link_foto_profile'] = $file;
        }

        $reseller->update($validated);

        return redirect()->route('profile-reseller.index')->with('success', 'Profile berhasil diperbarui.');
    }
}