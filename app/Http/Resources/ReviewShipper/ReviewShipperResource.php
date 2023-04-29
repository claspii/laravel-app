<?php

namespace App\Http\Resources\ReviewShipper;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewShipperResource extends JsonResource
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
         "id_shipper"=>$this->id_shipper,
         "avarage_star"=>$this->average_star,
         "number_review"=>$this->number_review,
        ];
    }
}
