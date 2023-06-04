<?php

namespace App\Http\Resources\Food;

use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
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
            'type'=>$this->type,
            'first_price'=>$this->first_price,
            'last_price'=>$this->last_price,
            'name'=>$this->name,
            'id_shop'=>$this->id_shop,
            'image' => $this->image,
            'des' => $this->des
        ];
    }
}
