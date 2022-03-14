<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SportResource extends JsonResource
{

    public function toArray($request)
    {
        return parent::toArray($request);

        /****** Alternative *******
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
        */
        
    }
}
