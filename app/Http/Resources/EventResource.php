<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'poster' => $this->poster ? asset('storage/' . $this->poster) : null,
            'proposal' => $this->proposal ? asset('storage/' . $this->proposal) : null,
            'description' => $this->description,
            'location' => $this->location,
            'first_event_date' => $this->first_event_date,
            'last_event_date' => $this->last_event_date,
            'register_deadline' => $this->register_deadline,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
