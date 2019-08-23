<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use Faker\Factory as Faker;
use App\Models\Order;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class OrderTest extends TestCase
{    
    use DatabaseMigrations;

    private $faker;

    public function __construct()
    {
        $this->faker = Faker::create();
    }
    
    public function testUserCanAccessHisOrders()
    {
        $users = factory(User::class, 5)->create();
        $users->wasRecentlyCreated = false;

        $orders = factory(Order::class, 5)->create([
            'user_id' => (int) $users[2]->id
        ]);
        $orders->wasRecentlyCreated = false;

        $response = $this->actingAs($users[2], 'api')
                        ->json('GET', '/api/v1/orders');
        
        $response->assertStatus(200)
                ->assertJsonStructure([
                    'data' => [
                        '*' => [
                            'id',
                            'title',
                            'status',
                            'amount'
                        ]
                    ]
                ])
                ->assertJsonFragment([
                    'user_id' => (int) $users[2]->id
                ]);
    }

    public function testUserCantAccessOtherOrders()
    {
        $users = factory(User::class, 5)->create();
        $users->wasRecentlyCreated = false;

        $orders = factory(Order::class, 5)->create([
            'user_id' => (int) $users[2]->id
        ]);
        $orders->wasRecentlyCreated = false;

        $response = $this->actingAs($users[3], 'api')
                        ->json('GET', '/api/v1/orders');
        
        $response->assertStatus(204);
    }

    public function testUserCanCreateOrders()
    {
        $users = factory(User::class, 5)->create();
        $users->wasRecentlyCreated = false;

        $response = $this->actingAs($users[3], 'api')
                        ->json('POST', '/api/v1/orders', [
                            'title' => $title = $this->faker->sentence($nbWords = 6, $variableNbWords = true),
                            'status' => $status = $this->faker->randomElement($array = array ('draft','accepted','delivered')),
                            'amount' => $amount = $this->faker->numberBetween(000, 99999)
                        ]);
        
        $response->assertStatus(201)
                ->assertJson([
                    'data' => [
                        'user_id' => (int) $users[3]->id,
                        'title' => $title,
                        'status' => $status,
                        'amount' => $amount
                    ]
                ]);
    }

    public function testCantCreateOrderWithoutTitle()
    {
        $users = factory(User::class, 5)->create();
        $users->wasRecentlyCreated = false;

        $response = $this->actingAs($users[3], 'api')
                        ->json('POST', '/api/v1/orders', [
                            'status' => $status = 'cancelled',
                            'amount' => $amount = $this->faker->numberBetween(000, 99999)
                        ]);
        
        $response->assertStatus(422)
                ->assertJsonStructure([
                    'errors' => [
                        '*' => [
                            'error',
                            'message',
                            'hint'
                        ]
                    ]
                ]);
    }

    public function testCantCreateOrderWithInvalidStatus()
    {
        $users = factory(User::class, 5)->create();
        $users->wasRecentlyCreated = false;

        $response = $this->actingAs($users[3], 'api')
                        ->json('POST', '/api/v1/orders', [
                            'title' => $title = $this->faker->sentence($nbWords = 6, $variableNbWords = true),
                            'status' => $status = 'cancelled',
                            'amount' => $amount = $this->faker->numberBetween(000, 99999)
                        ]);
        
        $response->assertStatus(422)
                ->assertJsonStructure([
                    'errors' => [
                        '*' => [
                            'error',
                            'message',
                            'hint'
                        ]
                    ]
                ]);
    }

    public function testCantCreateOrderWithNegativeAmount()
    {
        $users = factory(User::class, 5)->create();
        $users->wasRecentlyCreated = false;

        $response = $this->actingAs($users[3], 'api')
                        ->json('POST', '/api/v1/orders', [
                            'status' => $status = 'cancelled',
                            'amount' => $amount = -354
                        ]);
        
        $response->assertStatus(422)
                ->assertJsonStructure([
                    'errors' => [
                        '*' => [
                            'error',
                            'message',
                            'hint'
                        ]
                    ]
                ]);
    }

    public function testCantCreateOrderWithExcesiveAmount()
    {
        $users = factory(User::class, 5)->create();
        $users->wasRecentlyCreated = false;

        $response = $this->actingAs($users[3], 'api')
                        ->json('POST', '/api/v1/orders', [
                            'title' => $title = $this->faker->sentence($nbWords = 6, $variableNbWords = true),
                            'status' => $status = $this->faker->randomElement($array = array ('draft','accepted','delivered')),
                            'amount' => $amount = 85214568
                        ]);
        
        $response->assertStatus(422)
                ->assertJsonStructure([
                    'errors' => [
                        '*' => [
                            'error',
                            'message',
                            'hint'
                        ]
                    ]
                ]);
    }
}