<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('customer_id')
                ->index('customer_id_index');

            $table->unsignedInteger('seat_id')
                ->index('seat_id_index');

            $table->unsignedInteger('showing_id')
                ->index('showing_id_index');

            $table->unsignedInteger('reference_id')
                ->index('reference_id_index');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
