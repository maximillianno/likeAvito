<?php

use Faker\Generator as Faker;

$factory->define(App\Region::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->unique()->city,
        'slug' => $faker->unique()->slug(2),
        'slug' => str_slug($name),
        'parent_id' => null,
        //
    ];
});
