<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->user->id,
            'reviewer_id' => $this->id,
            'picture' => $this->user->picture,
            'birth_date' => $this->birth_date,
            'email'=> $this->user->email,
            'full_name' => $this->user ? $this->user->first_name . ' ' . $this->user->last_name : '',

        ];
    }
}
