<?php

namespace modules\AdminManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\AdminManagement\Models\Admin;

class AdminManagementController extends Controller
{
    public function admin(Request $request): Response
    {
        return response($request->user('admin'));
    }

    public function register(Request $request): Response
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:admins',
            'password' => 'required|string|confirmed',
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response($admin, Response::HTTP_CREATED);
    }

    public function login(Request $request): Response
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            return response(['message' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
        }

        $admin = Auth::guard('admin')->user();

        $token = $admin->createToken('admin-token')->plainTextToken;

        return response(['token' => $token], Response::HTTP_OK);
    }

    public function logout(Request $request): Response
    {
        $request->user('admin')->tokens()->delete();

        return response(['message' => 'Logged out'], Response::HTTP_OK);
    }
}

