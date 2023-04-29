<?php

namespace App\Http\Resources\Account;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
        "id"=>$this->id,
        "username"=>$this->username,
        "password"=>$this->password,
        "id_role"=>$this->id_role,
        "change_day"=>$this->changeday,
        ];
    }
}
