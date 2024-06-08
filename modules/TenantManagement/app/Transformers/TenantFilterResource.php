<?php

namespace modules\TenantManagement\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Stancl\Tenancy\Database\Models\Domain;

class TenantFilterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'domain' => $this->findDomain($this->id)->domain ?? 'N/A', // Call the method within the class
            'database' => $this->tenancy_db_name,
            'created_at' => $this->created_at->format('Y-m-d'), // Use format directly on Carbon instance
            'updated_at' => $this->updated_at->format('Y-m-d'),
        ];
    }

    // Method to find the domain
    public function findDomain($tenantId)
    {
        return Domain::where('tenant_id', $tenantId)->first();
    }
}
