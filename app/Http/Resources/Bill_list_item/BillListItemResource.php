<?php

namespace App\Http\Resources\Bill_list_item;

use Illuminate\Http\Resources\Json\JsonResource;

class BillListItemResource extends JsonResource
{
    
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'id_user'=>$this->id_user,
        ];
    }
}
