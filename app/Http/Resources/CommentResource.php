<?php

namespace App\Http\Resources;

use App\Enum\CommentableTypeEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

     public function getCommentableType(): string
     {

         $commentableType = CommentableTypeEnum::fromValue($this->commentable_type);
         
         return $commentableType ? $commentableType->name : 'Unknown Type';
     }
 
     public function toArray(Request $request): array
     {
         return [
             'id' => $this->id,
             'message' => $this->message,
             'commentable_id' => $this->commentable_id,
             'commentable_type' => $this->getCommentableType(),
             'reply_id' => $this->reply_id,
             'reviewer_id' => $this->reviewer_id,
         ];
     }
 }