<?php

namespace App\Http\Resources;

use App\Models\clients;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "user_id" => $this->user_id,
            'name' => $this->name,
            'BMI' => $this->BMI,
            'email' => $this->email,
            'weight' => $this->weight,
            'height' => $this->height,
            'day_counter_progression' => $this->day_counter_progression,
            'role' => $this->role,
            'comments' => is_null($this->employe) ? null : CommentResource::collection($this->employe),
        ];
    }
}
