<?php

namespace App\Http\Resources;

use App\Fee;
use App\Http\Resources\Fees as FeeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource
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
            'value' => $this->value,
            'acronym' => $this->acronym,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'fee' => new FeeResource(Fee::find($this->fee_id)),
        ];
    }
}
