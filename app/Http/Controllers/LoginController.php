<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $data['title'] = 'Login';
        return view('login', $data);
    }

    public function authenticationLogin(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // Mencari user berdasarkan email
        $user = User::where('email', $request->input('email'))->first();

        // Cek apakah pengguna ditemukan dan password cocok
        if ($user && Hash::check($request->input('password'), $user->password)) {
            // Login menggunakan session Laravel
            Auth::login($user);

            // Redirect ke dashboard dengan pesan sukses
            return redirect()->route('dashboard')->with('success', 'Selamat datang di menu Admin');
        } else {
            // Jika login gagal
            return redirect()->back()->withInput($request->all())->withErrors(['email' => 'Email atau password salah']);
        }
    }
    public function logout(Request $request)
    {
        // Hapus id_user dan id_role dari session
        $request->session()->forget('id_user');

        // Mengarahkan pengguna ke halaman login setelah logout
        return redirect('/login');
    }
}
