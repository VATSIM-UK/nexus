<?php

namespace App\Http\Resources\UKCP;

use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AirfieldCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'airfields' => $this->collection,
        ];
    }

    /**
     * Search for an AirfieldResource in the collection.
     *
     * @param string $searchTerm
     * @return $this
     */
    public function search(string $searchTerm): AirfieldCollection
    {
        if (!$searchTerm) {
            return new static($this->collection);
        }
        return new static($this->collection->filter(fn ($item) => Str::contains($item['code'], $searchTerm) || stristr($item['code'], $searchTerm)));
    }
}
