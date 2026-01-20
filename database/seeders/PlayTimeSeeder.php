<?php

namespace Database\Seeders;

use App\Models\Field;
use App\Models\PlayTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlayTimeSeeder extends Seeder
{
    public function run(): void
    {
        $startHour = 8;
        $endHour = 20;
        $fieldIds = Field::pluck('id');

        for ($hour = $startHour; $hour < $endHour; $hour++) {
            $startTime = sprintf('%02d:00:00', $hour);
            $endTime = sprintf('%02d:00:00', $hour + 1);

            foreach ($fieldIds as $fieldId) {
                PlayTime::factory()->create([
                    'start_time' => $startTime,
                    'end_time' => $endTime,
                    'field_id' => $fieldId,
                ]);
            }
        }
    }
}
