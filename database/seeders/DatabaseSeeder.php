<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Screen;
use App\Models\Seat;
use App\Models\Movie;
use App\Models\Showing;
use App\Models\Customer;
use App\Models\Booking;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $screen = Screen::factory()
            ->has(Seat::factory()->count(10))
            ->create();

        $movie = Movie::factory()->create();

        $showing = Showing::factory()
            ->for($screen)
            ->for($movie)
            ->create();

        $customer = Customer::factory()->create();

        $booking = Booking::factory()
            ->for($customer)
            ->for($screen->seats->first())
            ->for($showing)
            ->create();
    }
}
