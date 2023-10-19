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
        $daysOfWeek = [
            1 => 'Понедельник',
            2 => 'Вторник',
            3 => 'Среда',
            4 => 'Четверг',
            5 => 'Пятница',
            6 => 'Суббота',
            7 => 'Воскресенье',
        ];

        $convertedDays = array_map(function ($day) use ($daysOfWeek) {
            return $daysOfWeek[(int)$day];
        }, json_decode($this->days_of_week));

        return [
            'title' => $this->title,
            'text' => $this->text,
            'user_id' => $this->user->first_name,
            'job_time' => $this->job_time,
            'days_of_week' => $convertedDays,
        ];
    }

    private function getFormattedDaysOfWeek()
    {
        $daysOfWeek = $this->days_of_week; // Используем массив напрямую

        $formattedDays = [];

        foreach ($daysOfWeek as $day) {
            $carbonDate = Carbon::parse($day);
            $formattedDays[] = $carbonDate->isoFormat('dddd');
        }

        return $formattedDays;
    }






}
