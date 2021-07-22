<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screen extends Model
{
    use HasFactory;

    /**
     * Get the seats for the screen
     */
    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
}
