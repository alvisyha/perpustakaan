<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use Faker\Factory as Faker;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i=0; $i <2 ; $i++) { 
            Book::create([
                'title' => $faker->sentence(2),
                'stock' => '100',
                'total_pages' => '200',
                'cover_image' => 'https://picsum.photos/1200/350?random=',
                'category' => 'fiksi',
                'author' => $faker->name,
                'publisher' => $faker->company,
                'description' => $faker->text
            ]);
        }
    }
}