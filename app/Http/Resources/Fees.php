<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Fees extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'heading' => $this->heading,
            'value' => $this->value,
            'amount' => $this->amount,
            'unit' => $this->unit,
            'jurisdiction' => $this->jurisdiction,
            'applicable_vat' => __('taxes.'.$this->jurisdiction),
            'minimum' => $this->minimum,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
