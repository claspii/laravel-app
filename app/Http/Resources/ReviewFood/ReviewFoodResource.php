<?php

namespace App\Http\Resources\ReviewFood;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewFoodResource extends JsonResource
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
            "id_shop"=>$this->id_shop,
            "id_user"=>$this->id_user,
            "des"=>$this->des,
            "thoi_gian"=>$this->thoigian,
            "star"=>$this->star,
        ];
    }
}
