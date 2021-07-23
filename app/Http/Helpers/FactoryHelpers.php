<?php

namespace App\Http\Helpers;

use App\Models\Customer;
use App\Models\Screen;
use App\Models\Seat;
use App\Models\Movie;
use App\Models\Showing;
use App\Models\Booking;

class FactoryHelpers
{
    /**
     * Generates a showing with fake data 
     * 
     * @return Showing
     */
    public static function generateShowing()
    {
        $screen = Screen::factory()
            ->has(Seat::factory()->count(10))
            ->create();

        $movie = Movie::factory()->create();

        return Showing::factory()
            ->for($screen)
            ->for($movie)
            ->create();
    }

    /**
     * Generates a showing with fake data 
     * 
     * @param Showing $showing
     * 
     * @return Booking
     */
    public static function generateBooking($showing = null)
    {
        if (!$showing) {
            $showing = self::generateShowing();
        }
        
        $customer = Customer::factory()->create();

        return Booking::factory()
            ->for($customer)
            ->for($showing->screen->seats->random())
            ->for($showing)
            ->create();
    }
}
