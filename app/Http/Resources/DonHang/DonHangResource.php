<?php

namespace App\Http\Resources\DonHang;

use Illuminate\Http\Resources\Json\JsonResource;

class DonHangResource extends JsonResource
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
           "id_trang_thai"=>$this->id_trangthai,
           "id_food"=>$this->id_food,
           "tong_tien"=>$this->tongtien,
        ];
    }
}
