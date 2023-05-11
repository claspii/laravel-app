<?php

namespace App\Http\Resources\Bill;

use Illuminate\Http\Resources\Json\JsonResource;

class BillResource extends JsonResource
{
    
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'id_user'=>$this->id_user,
        ];
    }
}
