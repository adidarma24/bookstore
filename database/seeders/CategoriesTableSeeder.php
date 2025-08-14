<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $categories = ['Fiction', 'Non-Fiction', 'Science', 'History', 'Biography', 'Fantasy', 'Romance', 'Mystery', 'Thriller', 'Horror'];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }

        // Generate random sub-categories
        for ($i = 0; $i < 2990; $i++) {
            Category::create([
                'name' => $faker->word . ' ' . $faker->word,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}
