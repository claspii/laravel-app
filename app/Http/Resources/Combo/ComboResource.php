<?php

namespace App\Http\Resources\Combo;

use Illuminate\Http\Resources\Json\JsonResource;

class ComboResource extends JsonResource
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
          'id'=>$this->id,
          'des'=>$this->des,
          'id_shop'=>$this->id_shop,
        ];
    }
}
