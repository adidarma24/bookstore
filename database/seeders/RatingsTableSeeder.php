<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Rating;
use Faker\Factory as Faker;

class RatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $books = Book::pluck('id')->toArray();

        for ($i = 0; $i < 500000; $i++) {
            Rating::create([
                'book_id' => $faker->randomElement($books),
                'rating' => $faker->numberBetween(1, 10),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);

            // Show progress for large dataset
            if ($i % 10000 === 0) {
                echo "Processed $i ratings out of 500000\n";
            }
        }
    }
}
