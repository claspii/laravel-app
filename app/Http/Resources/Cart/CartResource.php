<?php

namespace App\Http\Resources\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'id_user'=>$this->id_user,
        ];
    }
}
