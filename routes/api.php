<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\MovieController;
use App\Http\Controllers\Api\ShowingController;
use App\Http\Controllers\Api\BookingController;

/** Customer routes */
Route::get('customers', [CustomerController::class, 'getAllCustomers']);
Route::get('customers/{customer}', [CustomerController::class, 'getCustomer']);

Route::post('customers', [CustomerController::class, 'createCustomer']);
Route::put('customers/{customer}', [CustomerController::class, 'updateCustomer']);
Route::delete('customers/{customer}', [CustomerController::class, 'deleteCustomer']);


/** Movie routes */
Route::get('movies', [MovieController::class, 'getAllMovies']);
Route::get('movies/{movie}', [MovieController::class, 'getMovie']);

Route::post('movies', [MovieController::class, 'createMovie']);
Route::put('movies/{movie}', [MovieController::class, 'updateMovie']);
Route::delete('movies/{movie}', [MovieController::class, 'deleteMovie']);


/** Showings routes */
Route::get('showings', [ShowingController::class, 'getAllShowings']);
Route::get('showings/{showing}', [ShowingController::class, 'getShowing']);
Route::get(
    'showings/{showing}/seat-availability',
    [
        ShowingController::class,
        'getShowingSeatAvailability'
    ]
);

Route::post('showings', [ShowingController::class, 'createShowing']);
Route::put('showings/{showing}', [ShowingController::class, 'updateShowing']);
Route::delete('showings/{showing}', [ShowingController::class, 'deleteShowing']);



/** Bookings routes */
Route::get('bookings', [BookingController::class, 'getAllBookings']);
Route::get('bookings/{booking}', [BookingController::class, 'getBooking']);

Route::post('bookings', [BookingController::class, 'createBooking']);
Route::put('bookings/{booking}', [BookingController::class, 'updateBooking']);
Route::delete('bookings/{booking}', [BookingController::class, 'deleteBooking']);
