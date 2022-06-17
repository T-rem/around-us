<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlannerResource extends JsonResource
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
            'team_id' => $this->team_id,
            'quiz_id' => $this->quiz_id,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
        ];
    }
}
