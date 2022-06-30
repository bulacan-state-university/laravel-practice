<?php

namespace App\Http\Resources\Soda;

use Illuminate\Http\Resources\Json\JsonResource;

class SodaResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'flavor' => $this->flavor,
        ];
    }
}
