<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {

        factory(\App\Models\Product::class, 10)->create();

        $faker=new Faker;
        $products=\App\Models\Product::select('id')->get();
        foreach ($products as $product) {
            $product->addMediaFromUrl("https://lorempixel.com/640/480/?93991")->toMediaCollection('products');
        }
    }
}
