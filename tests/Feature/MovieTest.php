<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Faker\Factory as Faker;
use App\Http\Helpers\FactoryHelpers;

use App\Models\Movie;

class MovieTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test getting all movies
     *
     * @return void
     */
    public function test_get_all_movies()
    {
        $response = $this->get('/api/movies');

        $response->assertStatus(200);
    }

    /**
     * Test getting a single movie
     *
     * @return void
     */
    public function test_get_first_movie()
    {
        $movie = FactoryHelpers::generateMovie();

        $response = $this->get("/api/movies/$movie->id");

        $response->assertStatus(200);
    }

    /**
     * Test creating a movie
     *
     * @return void
     */
    public function test_create_movie()
    {
        $response = $this->post(
            '/api/movies',
            [
                'name'  => implode(' ', Faker::create()->words(3)),
            ]
        );

        $response->assertStatus(201);
    }

    /**
     * Test updating a movie
     *
     * @return void
     */
    public function test_update_movie()
    {
        $movie = FactoryHelpers::generateMovie();

        $response = $this->put(
            "/api/movies/$movie->id",
            [
                'name'  => implode(' ', Faker::create()->words(3)),
            ]
        );

        $response->assertStatus(201);
    }

    /**
     * Test deleting a movie
     *
     * @return void
     */
    public function test_delete_movie()
    {
        $movie = FactoryHelpers::generateMovie();
        
        $response = $this->delete("/api/movies/$movie->id");

        $response->assertStatus(202);
    }
}
