<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $json = File::get(database_path('data/orders.json'));
        $orders = json_decode($json, true);

        foreach ($orders as $data) {
            Order::create($data);
        }
    }
}

