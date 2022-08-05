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
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->foreignId('store_id')->constrained('stores');
            $table->foreignId('cargo_id')->constrained('cargos');
            $table->foreignId('shiptrip_id')->nullable()->constrained('ship_trips');
            $table->foreignId('store_dist_id')->nullable()->constrained('stores');
            $table->foreignId('loader_id')->nullable()->constrained('loaders');
            $table->foreignId('convair_id')->nullable()->constrained('convairs');
            $table->foreignId('convair_operator_id')->nullable()->constrained('operators');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('user2_id')->nullable()->constrained('users');
            $table->foreignId('operator_id')->nullable()->constrained('operators');
            $table->foreignId('operator2_id')->nullable()->constrained('operators');
            $table->foreignId('loader_operator_id')->nullable()->constrained('operators');
            $table->tinyInteger('start_shift')->nullable();
            $table->tinyInteger('end_shift')->nullable();
            $table->integer('gate_num')->nullable();
            $table->integer('weight');
            $table->timestamp('load_start')->nullable();
            $table->timestamp('load_end')->nullable();
            $table->text('load_notes')->nullable();
            $table->timestamp('shipping_start')->nullable();
            $table->timestamp('shipping_end')->nullable();
            $table->text('shipping_notes')->nullable();
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
        Schema::dropIfExists('shippings');
    }
};
