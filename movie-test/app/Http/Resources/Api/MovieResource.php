<?php

namespace App\Http\Resources\Api;

// Required Libraries
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
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
            'id'                => $this->id,
            'original_title'    => $this->original_title,   
            'title'             => $this->title,
            'thumb'             => config('app.the_movie_img') . $this->poster_path,
            'overview'          => $this->overview,
            'original_language' => $this->original_language
        ];
    }
}
