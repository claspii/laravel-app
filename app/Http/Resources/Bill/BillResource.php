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
            'payment_method'=>$this->payment_method,
            'created_at'=>$this->created_at,
            'id_user' => $this->id_user,
            'id_state' => $this->id_state
        ];
    }
}
