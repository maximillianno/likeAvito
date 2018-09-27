<?php

use Illuminate\Database\Seeder;

class AdvertsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\App\Category::class, 10)->create()->each(function (\App\Category $category){
           $counts = [0, random_int(3, 7)];
           $category->children()->saveMany(factory(\App\Category::class, $counts[array_rand($counts)])->create()->each(function (\App\Category $category){
               $counts = [0, random_int(3, 7)];
               $category->children()->saveMany(factory(\App\Category::class, $counts[array_rand($counts)])->create());

           }));
        });
    }
}
