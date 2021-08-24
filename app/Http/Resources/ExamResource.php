<?php

namespace App\Http\Resources;

use App\Http\Resources\QuestionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamResource extends JsonResource
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
            'name_en' => $this->name('en'),
            'name_ar' => $this->name('ar'),
            'desc_en' => $this->desc('en'),
            'desc_ar' => $this->desc('ar'),
            'image' => asset("uploads/$this->img"),
            'questions_no' => $this->questions_no,
            'difficulty' => $this->difficulty,
            'duration_mins' => $this->duration_mins,
            'active' => $this->active,
            'questions' => QuestionResource::collection($this->whenLoaded('questions')),
        ];
    }
}
