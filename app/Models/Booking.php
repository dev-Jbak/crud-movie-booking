<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Showing;
use App\Models\Customer;
use App\Models\Seat;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'showing_id',
        'seat_id',
        'reference_id'
    ];

    /**
     * Get the showing for the booking
     */
    public function showing()
    {
        return $this->belongsTo(Showing::class);
    }

    /**
     * Get the customer for the booking
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the seat for the booking
     */
    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }
}
