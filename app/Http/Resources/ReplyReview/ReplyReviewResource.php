<?php

namespace App\Http\Resources\ReplyReview;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReplyReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "id_review" => $this->id_review,
            "id_user" => $this->id_user,
            "des" => $this->des,
            "image" => $this->image
        ];
    }
}
