<?php

namespace App\Http\Resources\InforShipper;

use Illuminate\Http\Resources\Json\JsonResource;

class InforShipperResource extends JsonResource
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
            "id_account"=>$this->id_account,
            "name"=>$this->name,
            "address"=>$this->address,
            "img"=>$this->img,
        ];
    }
}
