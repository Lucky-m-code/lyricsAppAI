<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LyricsRequestResource extends JsonResource
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
            'user_id' => $request->user()->id,
            'music_name' => $this->music_name,
            'artist_name' => $this->artist_name,
            'url' => $this->url,


        ];
    }
}
