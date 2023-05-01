<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray([
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'steam' => $this->steam,
            'role' => $this->getRoleNames()[0],
            'permissions' => $this->getPermissionsViaRoles()->pluck("name"),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
    }
}
