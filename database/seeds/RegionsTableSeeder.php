<?php

use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\App\Region::class, 10)->create()->each(function(\App\Region $region){
           $region->children()->saveMany(factory(\App\Region::class, random_int(3,10))->create()->each(function(\App\Region $region){
               $region->children()->saveMany(factory(\App\Region::class, random_int(3, 10))->make());
           }));

        });
    }
}
