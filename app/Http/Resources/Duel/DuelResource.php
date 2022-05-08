<?php

namespace App\Http\Resources\Duel;

use Illuminate\Http\Resources\Json\JsonResource;

class DuelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'id_first' => $this->id_first,
            'id_second' => $this->id_second,
            'score_first' => $this->score_first,
            'score_second' => $this->score_second,
            'rating_first' => $this->rating_first,
            'rating_second' => $this->rating_second,
            'id_tournament' => $this->id_tournament,
            'index_duel' => $this->index_duel,
            'created_at' => $this->created_at->format('d.m.Y')
        ];
    }
}
