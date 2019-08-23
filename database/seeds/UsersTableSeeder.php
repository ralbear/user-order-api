<?php

use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        DB::table('users')->insert([
            [
                'name' => 'Jay',
                'email' => 'jay@domain.com',
                'password' => '$2y$10$DKM5h/dyinG6F1bPKNlCw.tTYaf9F.x6sgHFoFY77xTz4lKrJsnjW', // password
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Emma',
                'email' => 'emma@domain.com',
                'password' => '$2y$10$DKM5h/dyinG6F1bPKNlCw.tTYaf9F.x6sgHFoFY77xTz4lKrJsnjW', // password
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}