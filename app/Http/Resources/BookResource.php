<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'book_id' => $this->id,
            'name' => $this->name,
            'language' => $this->language,
            'publisher_id' => $this->publisher_id,
            'author_id' => $this->author_id,
        ];
    }
}
