<?php

namespace App\Http\Resources\ComboFood;

use Illuminate\Http\Resources\Json\JsonResource;

class ComboFoodResource extends JsonResource
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
            "id"=>$this->id,
            "id_food"=>$this->id_food,
            "id_combo"=>$this->id_combo,
        ];
    }
}
