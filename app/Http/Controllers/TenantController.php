<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function makeTenant()
    {
        $tenant = Tenant::create([
            'name' => 'Tenant ' . Tenant::count(),
        ]);

    }
}
