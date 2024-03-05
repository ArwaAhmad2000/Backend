<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminLoginController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['login', 'register']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::guard('admin')->attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data invalid',
            ], 401);
        }
        return $this->token($token);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:admins',
            'password' => 'required|string|min:6',
        ]);

        $admin = Admin::create(array_merge(
            $data,
            ['password' => bcrypt($request->password)]
        ));
        $token = Auth::login($admin);
        return $this->token($token);
    }


    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function me()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::guard('admin')->user(),
        ]);
    }

    public function refresh()
    {

        return response()->json([

            'token' => Auth::refresh(),
            'type' => 'bearer',
            'admin' => Auth::admin(),


        ]);
    }
    public function token($token)
    {
        $user = Auth::guard('admin')->user();
        return response()->json([

            'token' => $token,
            'type' => 'bearer',
            'admin' => $user,
        ]);
    }
}
