<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Faker\Factory as Faker;
use App\Http\Helpers\FactoryHelpers;

use App\Models\Customer;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test getting all customers
     *
     * @return void
     */
    public function test_get_all_customers()
    {
        $response = $this->get('/api/customers');

        $response->assertStatus(200);
    }

    /**
     * Test getting a single customer
     *
     * @return void
     */
    public function test_get_first_customer()
    {
        $customer = FactoryHelpers::generateCustomer();

        $response = $this->get("/api/customers/$customer->id");

        $response->assertStatus(200);
    }

    /**
     * Test creating a customer
     *
     * @return void
     */
    public function test_create_customer()
    {
        $faker = Faker::create();

        $response = $this->post(
            '/api/customers',
            [
                'name'  => $faker->name(),
                'email' => $faker->unique()->safeEmail()
            ]
        );

        $response->assertStatus(201);
    }

    /**
     * Test updating a customer
     *
     * @return void
     */
    public function test_update_customer()
    {
        $customer = FactoryHelpers::generateCustomer();

        $faker = Faker::create();

        $response = $this->put(
            "/api/customers/$customer->id",
            [
                'name'  => $faker->name(),
                'email' => $faker->unique()->safeEmail()
            ]
        );

        $response->assertStatus(201);
    }

    /**
     * Test deleting a customer
     *
     * @return void
     */
    public function test_delete_customer()
    {
        $customer = FactoryHelpers::generateCustomer();
        
        $response = $this->delete("/api/customers/$customer->id");

        $response->assertStatus(202);
    }
}
