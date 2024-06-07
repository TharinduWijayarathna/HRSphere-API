<?php

namespace modules\UserManagement\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use modules\TenantManagement\Models\Tenant;
use modules\UserManagement\Models\User;
use Stancl\Tenancy\Database\Models\Domain;

class UserManagementController extends Controller
{
    public function register(Request $request): Response
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        return response($user, Response::HTTP_CREATED);
    }

    public function login(Request $request): Response
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'subdomain' => 'required|string',
        ]);

        $domain = Domain::where('domain', $request->subdomain . '.' . config('tenancy.central_domains')[0])->first();

        if (!$domain) {
            return response([
                'message' => 'Invalid subdomain',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $tenant = Tenant::find($domain->tenant_id);

        if (!$tenant) {
            return response([
                'message' => 'Invalid tenant',
            ], Response::HTTP_UNAUTHORIZED);
        }

        tenancy()->initialize($tenant);

        if (!Auth::guard('web')->attempt($request->only('email', 'password'))) {
            return response([
                'message' => 'Invalid credentials',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::guard('web')->user();

        $token = $user->createToken('token')->plainTextToken;

        $cookie = cookie('token', $token, 60 * 24); // 1 day
        $tenantCookie = cookie('tenant', $tenant->id, 60 * 24); // 1 day

        return response([
            'message' => 'Authenticated',
            'token' => $token,
            'tenant' => $tenant->id,
        ])->withCookie($cookie)->withCookie($tenantCookie);
    }

    public function user(): Response
    {
        $user = Auth::guard('web')->user();
        return response($user, Response::HTTP_OK);
    }

    public function logout(Request $request): Response
    {
        $user = Auth::guard('web')->user();

        if ($user) {
            $user->tokens()->delete();
        }

        $cookie = Cookie::forget('token');
        $tenantCookie = Cookie::forget('tenant');

        return response([
            'message' => 'Logged out',
        ])->withCookie($cookie)->withCookie($tenantCookie);
    }
}
