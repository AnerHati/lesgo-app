<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        if (!$this->resource) {
            return [];
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'active_role' => $this->active_role,
            'latitude' => $this->when($request->user() && $request->user()->id === $this->id, $this->latitude),
            'longitude' => $this->when($request->user() && $request->user()->id === $this->id, $this->longitude),
            'distance' => $this->when(isset($this->distance), $this->distance),
            'roles' => $this->whenLoaded('roles', function() {
                return $this->roles->pluck('name');
            }),
            'tutor_profile' => $this->whenLoaded('tutorProfile'),
            'student_profile' => $this->whenLoaded('studentProfile'),
            'parent_profile' => $this->whenLoaded('parentProfile'),
            'created_at' => $this->created_at,
        ];
    }
}
