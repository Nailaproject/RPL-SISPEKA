<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Guru;
use App\Models\Siswa;

class AuthController extends Controller
{
    /* ================= LOGIN ================= */

    public function showLogin()
    {
        return view('auth.login');
    }

   public function login(Request $request)
{
    $request->validate([
        'role'     => 'required|in:admin,guru,wali',
        'login'    => 'required|string',
        'password' => 'required|string',
    ]);

    $query = User::where('role', $request->role);

    if ($request->role === 'admin') {
        $query->where('email', $request->login);
    }

    if ($request->role === 'guru') {
        $query->where('nip', $request->login);
    }

    if ($request->role === 'wali') {
        $query->where('nis', $request->login);
    }

    $user = $query->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return back()->withErrors(['login' => 'Login gagal']);
    }

    Auth::login($user);
    $request->session()->regenerate();

    return redirect()->route($user->role . '.dashboard');
}

    /* ================= REGISTER ================= */

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string',
            'role'     => 'required|in:guru,wali',

            'email'    => 'nullable|email|unique:users,email',

            'nip'      => 'nullable|unique:users,nip',
            'nis'      => 'nullable|unique:users,nis',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name'     => $validated['name'],
            'role'     => $validated['role'],
           'email'    => $validated['role'] === 'admin' ? $validated['email'] : null,
            'nip'      => $validated['role'] === 'guru' ? $validated['nip'] : null,
            'nis'      => $validated['role'] === 'wali' ? $validated['nis'] : null,
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil, silakan login.');
    }

    /* ================= LOGOUT ================= */

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
