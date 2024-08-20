<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
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
            'author_id' => $this->id,
            'picture' => $this->user->picture,
            'nationality' => $this->nationality,
            'birthday'=> $this->birth_date,
            'email'=> $this->user->email,
            'full_name' => $this->user ? $this->user->first_name . ' ' . $this->user->last_name : '',

        ];
    }
}



