<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Showing;

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
        'refernce_id'
    ];

    /**
     * Get the showing for the booking
     */
    public function showing()
    {
        return $this->hasOne(
            Showing::class,
            'id',
            'showing_id'
        );
    }
}
