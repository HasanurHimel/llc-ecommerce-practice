<?php

use Faker\Generator as Faker;
use App\Models\Category;

$factory->define(\App\Models\Product::class, function (Faker $faker) {
    return [
        'category_id'=> Category::all()->random()->id,
        'title'=> $faker->colorName,
        'description'=> $faker->realText(40),
        'in_stock'=>1,
        'price'=> random_int(100, 1000),
        'sale_price'=> random_int(100, 1000),

    ];
});

