<?php

namespace App\Http\Controllers\admin;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TenantController extends Controller
{
    public function makeTenant()
    {
        $tenant = Tenant::create([
            'name' => 'Test Tenant',
            'tenancy_db_name' => 'hr_sphere_test',
        ]);

        //create domain
        $domain = $tenant->domains()->create([
            'domain' => 'test.localhost',
        ]);

    }
}
