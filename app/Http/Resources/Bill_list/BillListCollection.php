<?php

namespace App\Http\Resources\Bill_list;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BillListCollection extends ResourceCollection
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
