<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Http\Helpers\FactoryHelpers;
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
        $showing = FactoryHelpers::generateShowing();
        $booking = FactoryHelpers::generateBooking($showing);
    }
}
