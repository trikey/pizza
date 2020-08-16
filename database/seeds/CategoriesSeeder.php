<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('categories')->truncate();

        $categories = collect([
            [
                'name' => 'Pizza',
                'slug' => Str::slug('Pizza'),
            ],
            [
                'name' => 'Rolls',
                'slug' => Str::slug('Rolls'),
            ],
            [
                'name' => 'Snacks',
                'slug' => Str::slug('Snacks'),
            ],
            [
                'name' => 'Drinks',
                'slug' => Str::slug('Drinks'),
            ]
        ]);

        $categories->each(function ($category) {
            Category::create($category);
        });
    }
}
