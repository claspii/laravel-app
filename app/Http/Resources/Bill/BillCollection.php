<?php

namespace App\Http\Resources\Bill;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BillCollection extends ResourceCollection
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
