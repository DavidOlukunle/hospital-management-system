<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    public function run(): void
    {
        $specialties = [
            [
                'name' => 'Cardiology',
                'description' => 'Medical care focused on the heart and cardiovascular system.',
            ],
            [
                'name' => 'Dermatology',
                'description' => 'Medical care focused on the skin, hair, and nails.',
            ],
            [
                'name' => 'General Medicine',
                'description' => 'General medical assessment, diagnosis, and treatment.',
            ],
            [
                'name' => 'Neurology',
                'description' => 'Medical care focused on the nervous system.',
            ],
            [
                'name' => 'Pediatrics',
                'description' => 'Medical care for infants, children, and adolescents.',
            ],
            [
                'name' => 'Psychiatry',
                'description' => 'Medical care focused on mental and behavioral health.',
            ],
        ];

        foreach ($specialties as $specialty) {
            Specialty::updateOrCreate(
                ['name' => $specialty['name']],
                $specialty
            );
        }
    }
}