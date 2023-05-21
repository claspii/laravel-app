<?php

namespace App\Http\Resources\ReplyReview;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ReplyReviewCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data'=>$this->collection,
            'response'=>[
                'status'=>'success',
                'code'=>200
            ]
        ];
    }
}
