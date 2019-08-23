<?php

use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        DB::table('orders')->insert([
            [
                'user_id' => 1,
                'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'status' => $faker->randomElement($array = array ('draft','accepted','delivered')),
                'amount' => $faker->numberBetween(000, 99999),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'user_id' => 1,
                'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'status' => $faker->randomElement($array = array ('draft','accepted','delivered')),
                'amount' => $faker->numberBetween(000, 99999),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'user_id' => 1,
                'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'status' => $faker->randomElement($array = array ('draft','accepted','delivered')),
                'amount' => $faker->numberBetween(000, 99999),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'user_id' => 2,
                'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'status' => $faker->randomElement($array = array ('draft','accepted','delivered')),
                'amount' => $faker->numberBetween(000, 99999),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'user_id' => 2,
                'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'status' => $faker->randomElement($array = array ('draft','accepted','delivered')),
                'amount' => $faker->numberBetween(000, 99999),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'user_id' => 2,
                'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'status' => $faker->randomElement($array = array ('draft','accepted','delivered')),
                'amount' => $faker->numberBetween(000, 99999),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'user_id' => 2,
                'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'status' => $faker->randomElement($array = array ('draft','accepted','delivered')),
                'amount' => $faker->numberBetween(000, 99999),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'user_id' => 1,
                'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'status' => $faker->randomElement($array = array ('draft','accepted','delivered')),
                'amount' => $faker->numberBetween(000, 99999),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
