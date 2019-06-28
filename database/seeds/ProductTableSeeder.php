<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create category in the table
        App\Category::create([
            'title' => 'homme'
        ]);

        App\Category::create([
            'title' => 'femme'
        ]);

        factory(App\Product::class, 80)->create()->each(function ($product) {
            $category = App\Category::find(rand(1, 2));

            // Select all files in the public folder images by category
            $files = File::allFiles(public_path('images/' . $category->title . 's'));

            // Add a random image
            $randomFile = $files[rand(0, count($files) - 1)];
            $randomFile = explode('images/', $randomFile)[1];
            $product->image_url = $randomFile;

            if ($product->status_product === "sold") {
                $product->salePrice = $product->price - ( $product->price * ( 20 / 100) );
            }

            $size = ['xs', 's', 'm', 'l', 'xl'];
            $size_bis = ['xs', 's', 'm', 'l', 'xl'];

            // Mix the values of a tables
            shuffle($size_bis);

            // Select only three sizes in the array
            $size_bis = array_slice($size_bis, 0, 3);

            // To put the sizes back in order
            $size = array_intersect($size,$size_bis );

            // Serialize data in the table
            $product->size = serialize($size);

            $product->category()->associate($category);
            $product->save();

        });

    }
}
