<?php

namespace modules\UserManagement\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cookie;
use Stancl\Tenancy\Database\Models\Domain;
use modules\UserManagement\Http\Models\User;

class UserManagementController extends Controller
{
    public function register(Request $request)
    {
        return User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'subdomain' => 'required',
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

        if(!Auth::attempt($request->only('email', 'password'))){
            return response([
                'message' => 'Invalid credentials',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $token = Auth::user()->createToken('token')->plainTextToken;

        $cookie = cookie('token', $token, 60 * 24);
        $tenantCookie = cookie('tenant', $tenant->id, 60 * 24);

        $response['token'] = $token;
        $response['tenant'] = $tenant->id;

        return response([
            'message' => 'Authenticated',
            'token' => $token,
            'tenant' => $tenant->id,
        ]);
    }

    public function user()
    {
        return Auth::user();
    }

    public function logout()
    {
        $cookie = Cookie::forget('jwt');

        return response([
            'message' => 'Logged out',
        ])->withCookie($cookie);
    }
}
