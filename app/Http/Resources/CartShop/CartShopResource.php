<?php

namespace App\Http\Resources\CartShop;

use Illuminate\Http\Resources\Json\JsonResource;

class CartShopResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'id_shop'=>$this->id_shop,
            'id_cart'=>$this->id_cart,
            'id_vouncher'=>$this->id_vouncher,
            'ship_price'=>$this->ship_price,
        ];
    }
}
