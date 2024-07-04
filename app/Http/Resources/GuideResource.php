<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GuideResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "guide_id" => $this->guide_id,
            'label' => $this->label,
            'guide' => $this->guide,
            'diet_id' => $this->diet_id,
        ];
    }
}
