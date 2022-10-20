<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class YDataProviderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "currency" => $this->currency,
            "original_price" => $this->original_price,
            "current_price" => $this->current_price,
            "status" => $this->status,
            "include_vat" => $this->include_VAT,
            "end_date" => $this->end_date,
        ];
    }
}
