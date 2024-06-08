<?php

namespace modules\TenantManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use modules\TenantManagement\Models\Tenant;
use modules\TenantManagement\Transformers\TenantFilterResource;
use Stancl\Tenancy\Database\Models\Domain;

class TenantManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function list()
    {
        return response()->json([
            'message' => 'List method',
        ]);
    }

    /**
     * Filter the specified resource.
     *
     * @param Request $request
     * @return Response
     */

    public function filter(Request $request)
    {
        $query = Tenant::with('domain')->orderBy('created_at', 'desc');
        if ($request->has('search')) {
            $query->where('data', 'like', '%' . $request->input('search') . '%');
        }

        $tenants = $query->paginate($request->input('size', 10), ['*'], 'page', $request->input('page', 1));
        return TenantFilterResource::collection($tenants);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $tenant = Tenant::create($request->all());

        Domain::create([
            'domain' => $request->input('domain'),
            'tenant_id' => $tenant->id,
        ]);
        return response()->json(['message' => 'Tenant and domain created successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function get($id)
    {
        return response()->json([
            'message' => 'Edit method',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        return response()->json([
            'message' => 'Update method',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function delete($id)
    {
        return response()->json([
            'message' => 'Destroy method',
        ]);
    }
}
