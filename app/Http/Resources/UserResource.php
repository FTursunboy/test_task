<?php

namespace App\Http\Resources;

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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'patronymic' => $this->patronymic,
            'gender' => $this->gender,
            'avatar_img' => $this->avatar_img,
            'login' => $this->login,
            'email' => $this->email,
            'birth_date' => $this->dirth_date,
        ];
    }
}
