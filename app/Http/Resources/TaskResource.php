<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */



    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'text' => $this->text,
            'user_id' => new UserResource($this->user),
            'job_time' => $this->time,
            'days_of_week' => $this->getFormattedDaysOfWeek(),
        ];
    }

    private function getFormattedDaysOfWeek()
    {
        $daysOfWeek = json_decode($this->days_of_week);
        $formattedDays = [];

        foreach ($daysOfWeek as $day) {
            $formattedDays[] = Carbon::now()->isoWeekday($day)->format('dddd');
        }

        return $formattedDays;
    }


}
