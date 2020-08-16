<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Category;
use App\Product;
use App\Image;
use \Symfony\Component\Finder\SplFileInfo;
use \Illuminate\Support\Facades\File;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('images')->truncate();
        \DB::table('products')->truncate();

        $pizzaCategoryId = Category::whereSlug('pizza')->first()->id;
        $rollsCategoryId = Category::whereSlug('rolls')->first()->id;
        $snacksCategoryId = Category::whereSlug('snacks')->first()->id;
        $drinksCategoryId = Category::whereSlug('drinks')->first()->id;

        $products = collect([
            [
                'name' => 'Pizza Napoletana',
                'slug' => Str::slug('Pizza Napoletana'),
                'price' => 22,
                'description' => 'Italy’s most emblematic culinary creation, the genuine pizza Napoletana is made with just a few simple ingredients and prepared in only two variations – marinara, the basic Neapolitan pizza topped with a tomato-based sauce flavored with garlic and oregano, and margherita, which is topped with tomatoes, mozzarella, and fresh basil leaves, a delicious combination whose colors are said to represent the Italian flag.',
                'is_popular' => 1,
                'category_id' => $pizzaCategoryId,
            ],
            [
                'name' => 'Pizza Margherita',
                'slug' => Str::slug('Pizza Margherita'),
                'price' => 16.79,
                'description' => 'Pizza Margherita is a delicacy that is literally fit for a queen. In 1889, Queen Margherita of Savoy visited Naples, where she was served a pizza that was made to resemble the colors of the Italian flag: red tomatoes, white mozzarella cheese, and green basil.',
                'is_popular' => 0,
                'category_id' => $pizzaCategoryId,
            ],
        ]);


        File::copyDirectory(database_path('seeds/images'), storage_path('app/public'));

        $products->each(function ($productData) {
            $product = new Product($productData);
            $product->save();

            $images = collect(File::files(storage_path("app/public/{$product->category->slug}/{$product->id}")));
            $images->each(function (SplFileInfo $imageFile) use ($product) {
                $product->images()->create([
                    'disk' => 'public',
                    'path' => str_replace(storage_path('app/public/'), '', $imageFile->getPathname()),
                ]);
            });


        });
    }
}
