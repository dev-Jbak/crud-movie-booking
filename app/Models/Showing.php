<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Screen;

class Showing extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'screen_id',
        'movie_id',
        'time',
    ];


    /**
     * Get the screen for the showing
     */
    public function screen()
    {
        return $this->belongsTo(Screen::class);
    }

    /**
     * Get the movie for the showing
     */
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    /**
     * Get the bookings for the showing
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

     /**
     * Get all IDs for the seats that have not been booked for the showing
     */
    public function getAvailableSeatIds()
    {
        $screen_seats = $this->screen->seats->pluck('id');
        $booked_seats = $this->bookings->pluck('seat_id');

        return $screen_seats->diff($booked_seats)->values();
    }
}
