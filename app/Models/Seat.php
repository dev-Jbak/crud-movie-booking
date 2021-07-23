<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'screen_id'
    ];

    /**
     * Get the bookings for the seat
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
