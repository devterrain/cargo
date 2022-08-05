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
        Schema::create('ship_trips', function (Blueprint $table) {
            $table->id();
            $table->date('arrival_date')->nullable();
            $table->date('tracky_date')->nullable();
            $table->date('shpping_bdate')->nullable();
            $table->date('shpping_edate')->nullable();
            $table->foreignId('ship_id')->constrained('ships');
            $table->foreignId('dock_id')->constrained('docks');
            $table->foreignId('cargo_id')->constrained('cargos');
            $table->foreignId('user_id')->constrained('users');
            $table->string('shipping_agency', 100);
            $table->boolean('active')->default(1);
            $table->decimal('quantitiy', 10, 3);
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
        Schema::dropIfExists('ship_trips');
    }
};
