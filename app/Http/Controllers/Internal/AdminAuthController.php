<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Internal\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Parameter;
use Carbon\Carbon;
use App\Helpers\Helper;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nip' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::where('nip', $request->nip)
            ->where('nama', $request->username)
            ->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return back()->with('error', 'NIP, Username, atau Password salah.');
        }

        Auth::guard('admin')->login($admin);

        $admin->update(['last_login' => now()]);

        return redirect()->intended(route('admin.dashboard'));
    }
    
    public function dashboard()
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login')->with('error', 'Silakan login dulu.');
        }

        $admin = Auth::guard('admin')->user();

        $settings = Parameter::where('group', 'setting')
            ->whereIn('nama', ['trx_ip', 'inbox_proses', 'trx_prosessor'])
            ->pluck('value', 'nama');

        return view('admin.dashboard', compact('admin','settings'));
    }

    public function updateParameter(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'value' => 'required|in:0,1',
        ]);

        $param = Parameter::where('group', 'setting')->where('nama', $request->nama)->first();

        if ($param) {
            $param->value = $request->value;
            $param->save();
            return response()->json(['status' => 'success', 'message' => 'Parameter berhasil diubah']);
        }

        return response()->json(['status' => 'error', 'message' => 'Parameter tidak ditemukan'], 404);
    }

    public function logout()
    {
        session()->forget(['admin_id', 'admin_nama', 'admin_role']);
        return redirect()->route('admin.login');
    }
}