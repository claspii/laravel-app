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
            "id_shop" => $this->id_shop,
            "value"=>$this->value,
            "number_of_vouncher"=>$this->number_of_vouncher
        ];
    }
}
