<?php

namespace App\Http\Resources\UKCP;

use Illuminate\Http\Resources\Json\JsonResource;

class AirfieldResource extends JsonResource
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
            'code' => $this->code,
            'stands_count' => $this->stands_count,
        ];
    }
}
