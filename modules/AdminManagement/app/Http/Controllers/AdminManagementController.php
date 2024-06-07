<?php

namespace modules\AdminManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
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
            'email' => 'required|string|email|unique:admins,email', // Updated validation rule
            'password' => 'required|string|confirmed',
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response($admin);
    }

    public function login(Request $request): Response
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            return response(['message' => 'Invalid credentials'], 401);
        }

        $admin = Auth::guard('admin')->user();

        $token = $admin->createToken('admin-token')->plainTextToken;

        return response(['token' => $token]);
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->user('admin')->tokens()->delete();

        return redirect('/');
    }
}
