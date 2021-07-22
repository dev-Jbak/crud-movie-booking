<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Movie;
use App\Http\Requests\CreateMovieRequest;
use App\Http\Requests\UpdateMovieRequest;

class MovieController extends Controller
{
    /**
     * Gets a list of all movies
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function getAllMovies()
    {
        $movies = Movie::get();
        
        return response($movies, 200);
    }

    /**
     * Gets a movie
     * 
     * @param App\Models\Movie
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function getMovie(Movie $movie)
    {
        return $movie;
    }

    /**
     * Creates a movie
     * 
     * @param App\Http\Requests\CreateMovieRequest
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function createMovie(CreateMovieRequest $request)
    {
        $movie = new Movie;

        $movie->name = $request->name;
        
        $movie->save();
  
        return response()->json(
            [
                'message' => 'Movie created successfully'
            ],
            201
        );
    }

    /**
     * Updates a movie
     * 
     * @param App\Http\Requests\UpdateMovieRequest
     * @param App\Models\Movie
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function updateMovie(UpdateMovieRequest $request, Movie $movie)
    {
        if ($request->name) {
            $movie->name = $request->name;
        }

        $movie->save();
  
        return response()->json(
            [
                'message' => 'Movie updated successfully'
            ],
            201
        );
    }

    /**
     * Deletes a movie
     * 
     * @param App\Models\Movie
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function deleteMovie(Movie $movie) {
        $movie->delete();

        return response()->json(
            [
                "message" => "Movie deleted successfully"
            ],
            202
        );
    }
}
