<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Showing;
use App\Http\Helpers\ValidationHelpers;
use App\Http\Requests\CreateShowingRequest;
use App\Http\Requests\UpdateShowingRequest;

class ShowingController extends Controller
{
    /**
     * Gets a list of all showings
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function getAllShowings()
    {
        $showings = Showing::get();
        
        return response($showings, 200);
    }

    /**
     * Gets a showing
     * 
     * @param App\Models\Showing
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function getShowing(Showing $showing)
    {
        return response($showing, 200);
    }

    /**
     * Gets a showing
     * 
     * @param App\Models\Showing
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function getShowingSeatAvailability(Showing $showing)
    {
        return $showing->getAvailableSeatIds();
    }

    /**
     * Creates a showing
     * 
     * @param App\Http\Requests\CreateShowingRequest
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function createShowing(CreateShowingRequest $request)
    {
        $screen_time_exists = Showing::where('screen_id', $request->screen_id)
            ->where('time', $request->time)
            ->exists();
        
        if ($screen_time_exists) {
            return ValidationHelpers::getResponse(['A time already exists for this screen']);
        }

        $showing = new Showing;

        $showing->screen_id = $request->screen_id;
        $showing->movie_id = $request->movie_id;
        $showing->time = $request->time;
        
        $showing->save();
  
        return response()->json(
            [
                'message' => 'Showing created successfully'
            ],
            201
        );
    }

    /**
     * Updates a showing
     * 
     * @param App\Http\Requests\UpdateShowingRequest
     * @param App\Models\Showing
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function updateShowing(UpdateShowingRequest $request, Showing $showing)
    {
        if ($request->screen_id) {
            $showing->screen_id = $request->screen_id;
        }
        
        if ($request->movie_id) {
            $showing->movie_id = $request->movie_id;
        }
        
        if ($request->time) {
            $showing->time = $request->time;
        }

        $showing->save();
  
        return response()->json(
            [
                'message' => 'Showing updated successfully'
            ],
            201
        );
    }

    /**
     * Deletes a showing
     * 
     * @param App\Models\Showing
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function deleteShowing(Showing $showing) {
        $showing->delete();

        return response()->json(
            [
                "message" => "Showing deleted successfully"
            ],
            202
        );
    }
}
