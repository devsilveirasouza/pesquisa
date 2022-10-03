<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $questions = $this->whenLoaded('questions');

        return  [
            'option_id'            =>  $this->id,
            'option_titulo'        =>  $this->titulo,
            'option_created_at'    =>  $this->created_at,
            'option_updated_at'    =>  $this->updated_at,
            'option_deleted_at'    =>  $this->deleted_at,
            'questions'            =>  new QuestionResource($questions),
        ];
    }
}
