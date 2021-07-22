<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Screen;
use App\Models\Seat;
use App\Models\Movie;
use App\Models\Showing;
use App\Models\Customer;

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

        Showing::factory()
            ->for($screen)
            ->for($movie)
            ->create();

        Customer::factory()->create();
    }
}
