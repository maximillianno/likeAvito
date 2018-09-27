<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
//         $this->call(RegionsTableSeeder::class);
//         $this->call(AdvertsCategorySeeder::class);

//        factory(\App\Region::class, 10)->create()->each(function(\App\Region $region){
//            $region->children()->saveMany(factory(\App\Region::class, random_int(3,10))->create()->each(function(\App\Region $region){
//                $region->children()->saveMany(factory(\App\Region::class, random_int(3, 10))->make());
//            }));
//
//        });
    }
}
