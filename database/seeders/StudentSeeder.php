<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use Carbon\Carbon;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::updateOrCreate(
            ['nis' => '12345'],
            [
                'name' => 'Andi Pratama',
                'class' => '12A',
                'birth_date' => Carbon::create(2005, 4, 15),
            ]
        );
    }
}
