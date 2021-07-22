<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Validation\ValidationException;

use App\Models\Booking;
use App\Models\Showing;
use App\Http\Helpers\ValidationHelpers;
use App\Http\Requests\CreateBookingRequest;
use App\Http\Requests\UpdateBookingRequest;

class BookingController extends Controller
{
    /**
     * Gets a list of all bookings
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function getAllBookings()
    {
        $bookings = Booking::get();
        
        return response($bookings, 200);
    }

    /**
     * Gets a booking
     * 
     * @param App\Models\Booking
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function getBooking(Booking $booking)
    {
        return $booking;
    }

    /**
     * Creates a booking
     * 
     * @param App\Http\Requests\CreateBookingRequest
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function createBooking(CreateBookingRequest $request)
    {
        $validated = $request->validated();

        $showing = Showing::find($request->showing_id);

        $available_seat_ids = $showing->getAvailableSeatIds();

        if ($request->seats > $available_seat_ids->count()) {
            return ValidationHelpers::getResponse(['There is not enough seats available to book']);
        }

        /**
         * Future to convert to be second table for booked_seats
         * So that auto-increment is for both with booking id as ref for booked_seats
         */
        $reference_id = (Booking::max('reference_id') ?? 0) + 1;
        foreach ($available_seat_ids->take($request->seats) as $seat_id) {
            $booking = new Booking;

            $booking->customer_id = $request->customer_id;
            $booking->showing_id = $request->showing_id;
            $booking->seat_id = $seat_id;
            $booking->reference_id = $reference_id;
            
            $booking->save();
        }       
  
        return response()->json(
            [
                'message' => 'Booking created successfully'
            ],
            201
        );
    }

    /**
     * Updates a booking
     * 
     * @param App\Http\Requests\UpdateBookingRequest
     * @param App\Models\Booking
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function updateBooking(UpdateBookingRequest $request, Booking $booking)
    {
        if ($request->seat_id) {
            $showing = $booking->showing;

            $available_seat_ids = $showing->getAvailableSeatIds();


            if (!$showing->screen->seats->contains($request->seat_id)) {
                return ValidationHelpers::getResponse(['The seat does not exist']);
            }

            if (!$available_seat_ids->contains($request->seat_id)) {
                return ValidationHelpers::getResponse(['This seat has already been taken']);
            }

            $booking->seat_id = $request->seat_id;
        }

        if ($request->customer_id) {
            $booking->customer_id = $request->customer_id;
        }
        
        if ($request->showing_id) {
            $booking->showing_id = $request->showing_id;
        }

        if ($request->reference_id) {
            $booking->reference_id = $request->reference_id;
        }

        $booking->save();
  
        return response()->json(
            [
                'message' => 'Booking updated successfully'
            ],
            201
        );
    }

    /**
     * Deletes a booking
     * 
     * @param App\Models\Booking
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function deleteBooking(Booking $booking) {
        $booking->delete();

        return response()->json(
            [
                "message" => "Booking deleted successfully"
            ],
            202
        );
    }
}
