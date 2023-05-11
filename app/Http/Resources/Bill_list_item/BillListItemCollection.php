<?php

namespace App\Http\Resources\Bill_list_item;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BillListItemCollection extends ResourceCollection
{

    public function toArray($request)
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
