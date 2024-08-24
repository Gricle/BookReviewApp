<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FollowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'followable_id' => $this->followable_id,
            'followable_type' => $this->followable_type,
            'reviewer_id' => $this->reviewer_id,
        ];
    }
}