<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Restaurant;

class RestaurantSeeder extends Seeder
{
    public function run()
    {
        $json = File::get(database_path('data/restaurants.json'));
        $restaurants = json_decode($json, true);

        foreach ($restaurants as $data) {
            Restaurant::create($data);
        }
    }
}

