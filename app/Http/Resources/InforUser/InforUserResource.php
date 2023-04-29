<?php

namespace App\Http\Resources\InforUser;

use Illuminate\Http\Resources\Json\JsonResource;

class InforUserResource extends JsonResource
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
            "first_name"=>$this->first_name,
            "last_name"=>$this->last_name,
            "phone_number"=>$this->phone_number,
            "address"=>$this->address,
            "avatar"=>$this->avatar,
        ];
    }
}
