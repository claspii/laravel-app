<?php

namespace App\Http\Resources\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CartCollection extends ResourceCollection
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
