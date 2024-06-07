<?php

namespace modules\TenantManagement\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TenantFilterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'domain' => $this->domain->domain,
            'database' => $this->tenancy_db_name,
            'created_at' => Date('Y-m-d', strtotime($this->created_at)),
            'updated_at' => Date('Y-m-d', strtotime($this->updated_at)),
        ];
    }
}
