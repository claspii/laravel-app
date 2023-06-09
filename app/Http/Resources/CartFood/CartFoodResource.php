<?php

namespace App\Http\Resources\CartFood;

use Illuminate\Http\Resources\Json\JsonResource;

class CartFoodResource extends JsonResource
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
            'id_cartshop'=>$this->id_cartshop,
            'id_food'=>$this->id_food,
            'quantity'=>$this->quantity
        ];
    }
}
