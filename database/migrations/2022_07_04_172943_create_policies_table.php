<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policies', function (Blueprint $table) {
            $table->id()->startingValue(1600);
            $table->date('shipping_date');
            $table->foreignId('destination_id')->constrained('destinations');
            $table->foreignId('origin_id')->constrained('origins');
            $table->foreignId('contractor_id')->constrained('contractors');
            $table->foreignId('driver_id')->constrained('drivers');
            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->foreignId('trailer_id')->constrained('trailers');
            $table->foreignId('cargo_id')->constrained('cargos');
            $table->foreignId('user_id')->constrained('users');
            $table->integer('empty_weight');
            $table->integer('loaded_weight');
            $table->integer('net_weight');
            $table->softDeletes();
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
        Schema::dropIfExists('policies');
    }
};
