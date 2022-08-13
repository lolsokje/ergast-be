<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DriverRaceResource extends JsonResource
{
    public function toArray($request): array
    {
        $race = $this->race;
        $constructor = $this->constructor;
        $status = $this->status;

        return [
            'id' => $race->id,
            'race' => $race->name,
            'date' => $race->date->format('F jS, Y'),
            'grid' => $this->grid,
            'position' => $this->position,
            'status' => $status->status,
            'team' => $constructor->name,
            'url' => $race->url,
        ];
    }
}
