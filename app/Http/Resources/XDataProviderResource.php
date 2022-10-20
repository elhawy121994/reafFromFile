<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class XDataProviderResource extends JsonResource
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
            "id" => $this->ProductIdentification,
            "name" => $this->ProductName,
            "currency" => $this->ProductCurrency,
            "original_price" => $this->ProductOriginalPrice,
            "current_price" => $this->ProductCurrentPrice,
            "status" => $this->StatusCode,
            "include_vat" => $this->IncludeVAT,
            "end_date" => $this->OfferEndDate,
        ];
    }
}

