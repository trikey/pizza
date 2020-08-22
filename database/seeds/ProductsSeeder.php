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
                'price' => 22.00,
                'description' => 'Italy’s most emblematic culinary creation, the genuine pizza Napoletana is made with just a few simple ingredients and prepared in only two variations – marinara, the basic Neapolitan pizza topped with a tomato-based sauce flavored with garlic and oregano, and margherita, which is topped with tomatoes, mozzarella, and fresh basil leaves, a delicious combination whose colors are said to represent the Italian flag.',
                'is_popular' => 0,
                'category_id' => $pizzaCategoryId,
            ],
            [
                'name' => 'Pizza Margherita',
                'slug' => Str::slug('Pizza Margherita'),
                'price' => 16.75,
                'description' => 'Pizza Margherita is a delicacy that is literally fit for a queen. In 1889, Queen Margherita of Savoy visited Naples, where she was served a pizza that was made to resemble the colors of the Italian flag: red tomatoes, white mozzarella cheese, and green basil.',
                'is_popular' => 1,
                'category_id' => $pizzaCategoryId,
            ],
            [
                'name' => 'Pizza Calzone',
                'slug' => Str::slug('Pizza Calzone'),
                'price' => 18.00,
                'description' => 'Traditional calzone dough, consisting of flour, yeast, olive oil, water, and salt, is kneaded and rolled into medium-sized disks. Each is then filled with cheeses such as ricotta, mozzarella, Parmesan, provolone, and other traditional vegetables or meats. The dough is then folded in half over the filling and sealed with an egg mixture in a half-moon shape, or is sometimes shaped into a ball by pinching and sealing all the edges at the top. It is then either baked or fried.',
                'is_popular' => 1,
                'category_id' => $pizzaCategoryId,
            ],
            [
                'name' => 'Pizza al tagli',
                'slug' => Str::slug('Pizza al tagli'),
                'price' => 17.75,
                'description' => 'This style of pizza popular casual food in Argentina, Uruguay and Malta, where for many years it has been a common way for people to grab a quick snack or meal. Pizza al taglio shops are also appearing in the United States. In each country, the style of crusts and toppings may be adapted to suit their own cultures.',
                'is_popular' => 1,
                'category_id' => $pizzaCategoryId,
            ],
            [
                'name' => 'Pizza pepperoni',
                'slug' => Str::slug('Pizza pepperoni'),
                'price' => 13.50,
                'description' => 'In restaurants, pizza can be baked in an oven with stone bricks above the heat source, an electric deck oven, a conveyor belt oven, or, in the case of more expensive restaurants, a wood or coal-fired brick oven. On deck ovens, pizza can be slid into the oven on a long paddle, called a peel, and baked directly on the hot bricks or baked on a screen (a round metal grate, typically aluminum). Prior to use, a peel may be sprinkled with cornmeal to allow pizza to easily slide onto and off of it. When made at home, it can be baked on a pizza stone in a regular oven to reproduce the effect of a brick oven. Cooking directly in a metal oven results in too rapid heat transfer to the crust, burning it',
                'is_popular' => 1,
                'category_id' => $pizzaCategoryId,
            ],
            [
                'name' => 'Chicago-style deep dish pizza',
                'slug' => Str::slug('Chicago-style deep dish pizza'),
                'price' => 25.00,
                'description' => 'The thick layer of toppings used in deep-dish pizza requires a longer baking time (typically 30–45 minutes), which could burn cheese or other toppings if they were used as the top layer of the pizza. Because of this, the toppings are assembled "upside-down" from their usual order on a pizza.',
                'is_popular' => 0,
                'category_id' => $pizzaCategoryId,
            ],
            [
                'name' => 'Pizza capricciosa',
                'slug' => Str::slug('Pizza capricciosa'),
                'price' => 18.00,
                'description' => 'Types of edible mushrooms used may include cremini (white mushrooms) and others. Some versions may also use prosciutto (a dry-cured ham), marinated artichoke hearts, olive oil, olives, basil leaves, and egg.',
                'is_popular' => 1,
                'category_id' => $pizzaCategoryId,
            ],
            [
                'name' => 'New york-style pizza',
                'slug' => Str::slug('New york-style pizza'),
                'price' => 25.00,
                'description' => 'New York-style pizza is pizza made with a characteristically large hand-tossed thin crust, often sold in wide slices to go. The crust is thick and crisp only along its edge, yet soft, thin, and pliable enough beneath its toppings to be folded in half to eat. Traditional toppings are simply tomato sauce and shredded mozzarella cheese.',
                'is_popular' => 1,
                'category_id' => $pizzaCategoryId,
            ],
            [
                'name' => 'Philadelphia roll',
                'slug' => Str::slug('Philadelphia roll'),
                'price' => 5.00,
                'description' => 'The Philadelphia roll is a type of sushi usually made with smoked salmon, cream cheese and cucumber. They can also include other ingredients such as other types of fish, avocado, green onions, and sesame seeds.',
                'is_popular' => 1,
                'category_id' => $rollsCategoryId,
            ],
            [
                'name' => 'California roll',
                'slug' => Str::slug('California roll'),
                'price' => 3.50,
                'description' => 'A type of sushi made with rice turned inside out (typical uramaki).',
                'is_popular' => 0,
                'category_id' => $rollsCategoryId,
            ],
            [
                'name' => 'Lays',
                'slug' => Str::slug('Lays'),
                'price' => 2.50,
                'description' => 'an appetizer, which is thin slices of potatoes (in British English chips - fries), less often - other root vegetables or various fruits, usually fried in oil (deep fried). It is often served with beer as a snack. Also, dip is sometimes served with chips - a thick sauce in which chips are dipped.',
                'is_popular' => 1,
                'category_id' => $snacksCategoryId,
            ],
            [
                'name' => 'Pepsi',
                'slug' => Str::slug('Pepsi'),
                'price' => 1.00,
                'description' => 'Pepsi is made with soda water, high fructose corn syrup, caramel color, sugar, phosphoric acid, caffeine, citric acid and natural flavors. One 12-ounce can of beverage contains 41 grams of carbohydrates (all from sugar), 30 mg of sodium, 0 grams of fat, 0 grams of protein, 38 mg of caffeine, and 150 calories.',
                'is_popular' => 1,
                'category_id' => $drinksCategoryId,
            ],
        ]);


        File::copyDirectory(database_path('seeds/images'), storage_path('app/public'));

        $products->each(function ($productData) {
            $product = new Product($productData);
            $product->save();

            $images = collect(File::files(storage_path("app/public/{$product->category->slug}/{$product->id}")));
            $images->each(function (SplFileInfo $imageFile) use ($product) {
                $img = file_get_contents($imageFile->getRealPath());
                $base64 = base64_encode($img);
                $product->images()->create([
                    'disk' => 'public',
                    'base64' => $base64,
                    'path' => str_replace(storage_path('app/public/'), '', $imageFile->getPathname()),
                ]);
            });


        });
    }
}
