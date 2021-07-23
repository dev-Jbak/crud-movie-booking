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
     * @param int $seats
     * 
     * @return Showing
     */
    public static function generateScreen($seats = 10)
    {
        return Screen::factory()
            ->has(Seat::factory()->count($seats))
            ->create();
    }

    /**
     * Generates a showing with fake data 
     * 
     * @return Showing
     */
    public static function generateMovie()
    {
        return Movie::factory()->create();
    }

    
    /**
     * Generates a Customer with fake data 
     * 
     * @return Customer
     */
    public static function generateCustomer()
    {
        return Customer::factory()->create();
    }

    /**
     * Generates a Showing with fake data 
     * 
     * @return Showing
     */
    public static function generateShowing()
    {
        $screen = self::generateScreen();
        $movie = self::generateMovie();

        return Showing::factory()
            ->for($screen)
            ->for($movie)
            ->create();
    }

    /**
     * Generates a Booking with fake data 
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
        
        $customer = self::generateCustomer();

        return Booking::factory()
            ->for($customer)
            ->for($showing->screen->seats->random())
            ->for($showing)
            ->create();
    }
}
