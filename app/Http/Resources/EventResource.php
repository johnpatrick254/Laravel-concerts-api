<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "name" => $this->name,
            "start_time" => $this->start_time,
            "end_time" => $this->end_time,
            "description" => $this->description,
            "user" => new UserResource($this->whenLoaded('user')),
            "attendee" => AttendeeResource::collection($this->whenLoaded('attendees')),
            "id" => $this->id
        ];
    }
}
