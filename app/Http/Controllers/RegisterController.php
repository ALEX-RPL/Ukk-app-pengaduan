<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $kelas = Kelas::orderBy('nama_kelas')->get();

        return view('auth.register', compact('kelas'));
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nis' => ['required', 'string', 'unique:users,nis', 'max:20'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email', 'max:255'],
            'kelas_id' => ['required', 'exists:kelas,id'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'nis' => $validated['nis'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'kelas_id' => $validated['kelas_id'],
            'password' => Hash::make($validated['password']),
            'role' => User::ROLE_SISWA,
        ]);

        Auth::login($user);

        return redirect()->route('home')
            ->with('success', 'Registrasi berhasil!');
    }
}
