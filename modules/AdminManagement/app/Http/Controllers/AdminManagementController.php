<?php

namespace Modules\AdminManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use modules\AdminManagement\Models\Admin;

class AdminManagementController extends Controller
{
    public function admin(Request $request): Response
    {
        return response($request->user());
    }

    public function register(Request $request): Response
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);

        $user = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response($user);
    }

    public function login(Request $request): Response
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response(['message' => 'Invalid credentials']);
        }

        $user = $request->user();

        $token = $user->createToken('token')->plainTextToken;

        return response(['token' => $token]);
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->user()->tokens()->delete();

        return redirect('/');
    }
}
