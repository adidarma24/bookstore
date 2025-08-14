<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $authors = Author::pluck('id')->toArray();
        $categories = Category::pluck('id')->toArray();

        for ($i = 0; $i < 100000; $i++) {
            Book::create([
                'title' => $faker->sentence($faker->numberBetween(3, 6)),
                'author_id' => $faker->randomElement($authors),
                'category_id' => $faker->randomElement($categories),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);

            // Show progress for large dataset
            if ($i % 5000 === 0) {
                echo "Processed $i books out of 100000\n";
            }
        }
    }
}
