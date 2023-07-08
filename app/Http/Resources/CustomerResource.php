<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "name" => $this->first_name." ". $this->last_name,
            "address" => $this->customer->address ?? null,
            "phone" => $this->phone,
            "created_at" => $this->created_at,
            "id" => $this->id,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
        ];
    }
}
