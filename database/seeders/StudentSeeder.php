<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use Faker\Factory as Faker;


class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i=1; $i <3 ; $i++) { 
            Student::create([
                'name' => $faker->name,
                'nisn' => $i,
                'class' => '10A',                
            ]);
        }
    }
}