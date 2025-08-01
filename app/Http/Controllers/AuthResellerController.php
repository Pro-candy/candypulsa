<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Reseller;
use Illuminate\Support\Str;

class AuthResellerController extends Controller
{
    // Tampilkan form login
    public function showLogin()
    {
        return view('member-area.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'login'    => 'required', // nomor_hp atau email
            'pin'      => 'required',
            'password' => 'required',
        ]);

        $reseller = Reseller::where(function ($q) use ($request) {
                $q->where('nomor_hp', $request->login)
                  ->orWhere('email', $request->login);
            })
            ->where('pin', $request->pin)
            ->first();

        if (!$reseller) {
            return back()->withErrors(['login' => 'Data tidak ditemukan. Pastikan nomor HP/email dan PIN benar.']);
        }

        if ($reseller->deleted === 'yes') {
            return back()->withErrors(['login' => 'Akun Anda telah dihapus. Silakan hubungi customer service.']);
        }

        if ($reseller->aktif !== 'yes') {
            return back()->with([
                'error' => 'Akun belum diverifikasi email. Silakan cek email Anda.',
                'unverified_email' => $reseller->email
            ]);
        }

        if (Hash::check($request->password, $reseller->password)) {
            Auth::guard('reseller')->login($reseller, $request->filled('remember'));
            $request->session()->regenerate(); // PERUBAHAN: regenerate session
            return redirect()->route('reseller.dashboard'); // PERUBAHAN: route name dashboard
        }

        return back()->withErrors(['login' => 'Password salah.']);
    }

    // Proses daftar (register)
    public function register(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string',
            'nomor_hp' => 'required|regex:/^08[0-9]{8,13}$/|unique:reseller,nomor_hp',
            'email'    => 'nullable|email|unique:reseller,email',
            'pin'      => 'required|digits:4',
            'password' => 'required|min:6|confirmed',
        ], [
            'nomor_hp.unique' => 'Nomor HP sudah terdaftar.',
            'email.unique'    => 'Email sudah terdaftar.',
            'pin.digits'      => 'PIN harus 4 digit angka.',
        ]);

        // Generate kode reseller otomatis
        $lastReseller = Reseller::where('kode', 'like', 'CP%')->orderByDesc('id')->first();
        if ($lastReseller && preg_match('/CP(\d{4})$/', $lastReseller->kode, $m)) {
            $nextNumber = (int)$m[1] + 1;
        } else {
            $nextNumber = 1;
        }
        $kode = 'CP' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        // Buat token verifikasi email
        $verifyToken = Str::random(40);

        $reseller = Reseller::create([
            'kode'                    => $kode,
            'nama'                    => $request->nama,
            'nomor_hp'                => $request->nomor_hp,
            'email'                   => $request->email,
            'pin'                     => $request->pin,
            'password'                => Hash::make($request->password),
            'tgl_daftar'              => now(),
            'aktif'                   => 'no',
            'verify_token'            => $verifyToken,
            'verify_token_created_at' => now(),
        ]);

        if ($request->email) {
            Mail::send('emails.reseller-verify', [
                'nama'      => $request->nama,
                'verifyUrl' => url('/member-area/verifikasi?token=' . $verifyToken)
            ], function ($m) use ($request) {
                $m->to($request->email)->subject('Verifikasi Email Candy Pulsa');
            });
        }

        return redirect('/')->with('success', 'Pendaftaran berhasil! Silakan cek email untuk verifikasi.');
    }

    // Proses verifikasi email
    public function verifyEmail(Request $request)
    {
        try {
            $token = $request->input('token');
            $reseller = Reseller::where('verify_token', $token)->first();

            if (!$reseller) {
                \Log::error('Token verifikasi tidak ditemukan', ['token' => $token]);
                return redirect('/')->with('error', 'Gagal verifikasi atau Link Kadaluarsa.');
            }

            if (now()->diffInHours($reseller->verify_token_created_at) > 24) {
                return redirect('/')->with('error', 'Link verifikasi sudah kadaluarsa.');
            }

            $reseller->aktif                   = 'yes';
            $reseller->verify_token            = null;
            $reseller->verify_token_created_at = null;
            $reseller->save();

            return redirect()->route('login')->with('success', 'Email berhasil diverifikasi! Silakan login.');
        } catch (\Exception $e) {
            \Log::error('Verifikasi email error', ['message' => $e->getMessage()]);
            return back()->with('error', 'Terjadi error: ' . $e->getMessage());
        }
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::guard('reseller')->logout();
        $request->session()->invalidate(); // PERUBAHAN: invalidate session
        $request->session()->regenerateToken(); // PERUBAHAN: regenerate CSRF token
        return redirect()->route('login');
    }

    // Resend verification
    public function resendVerification(Request $request)
    {
        $email = $request->input('email');
        $reseller = Reseller::where('email', $email)->first();

        if (!$reseller || $reseller->aktif === 'yes') {
            return redirect()->route('login')->with('error', 'Akun tidak ditemukan atau sudah aktif.');
        }

        $verifyToken = Str::random(40);
        $reseller->verify_token            = $verifyToken;
        $reseller->verify_token_created_at = now();
        $reseller->save();

        Mail::send('emails.reseller-verify', [
            'nama'      => $reseller->nama,
            'verifyUrl' => url('/member-area/verifikasi?token=' . $verifyToken)
        ], function ($m) use ($reseller) {
            $m->to($reseller->email)->subject('Verifikasi Email Candy Pulsa');
        });

        return redirect()->route('login')->with('success', 'Link verifikasi baru sudah dikirim.');
    }
}
