<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        // Middleware untuk melindungi endpoint tertentu
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Menampilkan halaman login.
     */
    public function index()
    {
        $data['title'] = 'Login';
        return view('login', $data);
    }


    /**
     * Registrasi pengguna baru.
     */
    public function register(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // Periksa apakah validasi gagal
        if ($validated->fails()) {
            return response()->json([
                'message' => 'Pendaftaran gagal',
                'errors' => $validated->errors()
            ], 422);
        }

        // Buat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => $user ? 'Pendaftaran berhasil' : 'Pendaftaran gagal'
        ]);
    }

    /**
     * Login pengguna.
     */
    // AuthController.php
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }

        return response()->json(['token' => $token]);
    }



    /**
     * Mendapatkan data pengguna yang sedang login.
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Logout pengguna.
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh token.
     */
    public function refresh()
    {
        $token = auth()->refresh();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
