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

class ShowingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test getting all showings
     *
     * @return void
     */
    public function test_get_all_showings()
    {
        $response = $this->get('/api/showings');

        $response->assertStatus(200);
    }

    /**
     * Test getting a single showing
     *
     * @return void
     */
    public function test_get_first_showing()
    {
        $showing = FactoryHelpers::generateShowing();

        $response = $this->get("/api/showings/$showing->id");

        $response->assertStatus(200);
    }

    /**
     * Test creating a showing
     *
     * @return void
     */
    public function test_create_showing()
    {
        $screen = Screen::factory()
            ->has(Seat::factory()->count(10))
            ->create();

        $movie = Movie::factory()->create();

        $response = $this->post(
            '/api/showings',
            [
                'movie_id'  => $movie->id,
                'screen_id' => $screen->id,
                'time'      => date('H:i:s', rand())
            ]
        );

        $response->assertStatus(201);
    }

    /**
     * Test updating a showing
     *
     * @return void
     */
    public function test_update_showing()
    {
        $showing = FactoryHelpers::generateShowing();

        $update_screen = Screen::factory()
            ->has(Seat::factory()->count(10))
            ->create();

        $update_movie = Movie::factory()->create();

        $response = $this->put(
            "/api/showings/$showing->id",
            [
                'movie_id'  => $update_movie->id,
                'screen_id' => $update_screen->id,
                'time'      => date('H:i:s', rand())
            ]
        );

        $response->assertStatus(201);
    }

    /**
     * Test deleting a showing
     *
     * @return void
     */
    public function test_delete_showing()
    {
        $showing = FactoryHelpers::generateShowing();
        
        $response = $this->delete("/api/showings/$showing->id");

        $response->assertStatus(202);
    }
}
