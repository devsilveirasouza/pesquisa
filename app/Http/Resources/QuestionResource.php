<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return  [
            'question_id'            =>  $this->id,
            'question_titulo'        =>  $this->titulo,
            'question_obrigatoria'   =>  $this->obrigatoria,
            'question_tipo'          =>  $this->tipo,
            'question_user'          =>  $this->user_id,
            'question_created_at'    =>  $this->created_at,
            'question_updated_at'    =>  $this->updated_at,
            'question_deleted_at'    =>  $this->deleted_at,
            'options'                =>  OptionResource::collection($this->whenLoaded('options')),
        ];
    }
}
