<?php

namespace App\Http\Resources\Vouncher;

use Illuminate\Http\Resources\Json\JsonResource;

class VouncherResource extends JsonResource
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
            "value"=>$this->value,
        ];
    }
}
