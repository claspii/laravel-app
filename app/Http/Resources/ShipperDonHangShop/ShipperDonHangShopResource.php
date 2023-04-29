<?php

namespace App\Http\Resources\ShipperDonHangShop;

use Illuminate\Http\Resources\Json\JsonResource;

class ShipperDonHangShopResource extends JsonResource
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
            "id_user"=>$this->id_user,
            "id_shipper"=>$this->id_shipper,
            "id_shop"=>$this->id_shop,
            "id_don_hang"=>$this->id_don_hang,
        ];
    }
}
