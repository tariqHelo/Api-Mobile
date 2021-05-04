<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TasksResource extends JsonResource
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
         'country_id' => $this->country->name,
         'city_id' => $this->city->name,
         'area_id' => $this->area->name,
         'brand_id' => $this->brand->name,
         'created_at' => (string) $this->created_at,
         'updated_at' => (string) $this->updated_at,
        ];  
     }
}
