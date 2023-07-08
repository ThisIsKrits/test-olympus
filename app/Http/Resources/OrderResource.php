<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            "invoice"=> $this->invoice_id,
            "name" => $this->name,
            "phone" => $this->phone,
            "address" => $this->address,
            "kelurahan" => $this->kelurahan,
            "kecamatan" => $this->kecamatan,
            "id" => $this->id,
            "url" => route('order.show',$this->id),
            "detail" => OrderDetailResource::collection($this->orderdetail),
        ];
    }
}
