<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Student extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'age' => $this->age,
            'classes'=> ClassModel::collection($this->whenLoaded('classes')),
            'count class'=>count(ClassModel::collection($this->classes)),

        ];


    }
}
