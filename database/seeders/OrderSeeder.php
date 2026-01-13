<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $orders = [
            [
                'user_id' => 1,
                'latitude' => 35.681236,
                'longitude' => 139.767125,
                'text' => '東京駅直結のカフェです',
                'money' => 1000,
            ],
            [
                'user_id' => 1,
                'latitude' => 35.658581,
                'longitude' => 139.745433,
                'text' => '東京タワー近くのレストランです',
                'money' => 1000,
            ],
            [
                'user_id' => 1,
                'latitude' => 35.714765,
                'longitude' => 139.796638,
                'text' => '浅草寺近くのお土産屋です',
                'money' => 1000,
            ],
        ];

        foreach ($orders as $order) {
            Order::create($order);
        }
    }
}