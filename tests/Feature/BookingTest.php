<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Http\Helpers\FactoryHelpers;

use App\Models\Screen;
use App\Models\Seat;
use App\Models\Movie;
use App\Models\Showing;
use App\Models\Customer;
use App\Models\Booking;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test getting all bookings
     *
     * @return void
     */
    public function test_get_all_bookings()
    {
        $response = $this->get('/api/bookings');

        $response->assertStatus(200);
    }

    /**
     * Test getting a single booking
     *
     * @return void
     */
    public function test_get_first_booking()
    {
        $booking = FactoryHelpers::generateBooking();

        $response = $this->get("/api/bookings/$booking->id");

        $response->assertStatus(200);
    }

    /**
     * Test creating a booking
     *
     * @return void
     */
    public function test_create_booking()
    {
        $showing = FactoryHelpers::generateShowing();

        $customer = FactoryHelpers::generateCustomer();

        $response = $this->post(
            '/api/bookings',
            [
                'customer_id'   => $customer->id,
                'showing_id'    => $showing->id,
                'seats'         => 3
            ]
        );

        $response->assertStatus(201);
    }

    /**
     * Test updating a booking
     *
     * @return void
     */
    public function test_update_booking()
    {
        $booking = FactoryHelpers::generateBooking();
        
        $update_showing = FactoryHelpers::generateShowing();
        $update_customer = FactoryHelpers::generateCustomer();

        $response = $this->put(
            "/api/bookings/$booking->id",
            [
                'customer_id'   => $update_customer->id,
                'showing_id'    => $update_showing->id,
                'seat_id'       => $update_showing->screen->seats->random()->id,
                'reference_id'  => rand()
            ]
        );

        $response->assertStatus(201);
    }

    /**
     * Test deleting a booking
     *
     * @return void
     */
    public function test_delete_booking()
    {
        $booking = FactoryHelpers::generateBooking();
        
        $response = $this->delete("/api/bookings/$booking->id");

        $response->assertStatus(202);
    }
}
