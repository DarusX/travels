<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimezonesToTrips extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->integer('start_timezone_id')->unsigned();
            $table->integer('end_timezone_id')->unsigned();

            $table->foreign('start_timezone_id')->references('id')->on('timezones');
            $table->foreign('end_timezone_id')->references('id')->on('timezones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->dropForeign('trips_end_timezone_id_foreign');
            $table->dropForeign('trips_start_timezone_id_foreign');

            $table->dropColumn('start_timezone_id');
            $table->dropColumn('end_timezone_id');
        });
    }
}
