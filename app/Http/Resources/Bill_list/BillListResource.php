<?php

namespace App\Http\Resources\Bill_list;

use Illuminate\Http\Resources\Json\JsonResource;

class BillListResource extends JsonResource
{
    
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'id_user'=>$this->id_user,
        ];
    }
}
