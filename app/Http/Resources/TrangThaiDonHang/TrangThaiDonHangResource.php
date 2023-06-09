<?php

namespace App\Http\Resources\TrangThaiDonHang;

use Illuminate\Http\Resources\Json\JsonResource;

class TrangThaiDonHangResource extends JsonResource
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
            "des"=>$this->des,
        ];
    }
}
