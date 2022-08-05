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
        Schema::create('convairs', function (Blueprint $table) {
            $table->id();
            $table->string('convair_num');
            $table->string('type', 40)->nullable();
            $table->string('length', 30)->nullable();
            $table->string('convair_power')->nullable();
            $table->string('convair_notes')->nullable();
            $table->foreignId('shiping_contractor_id')->constrained('shiping_contractors');
            $table->foreignId('user_id')->constrained('users');
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
        Schema::dropIfExists('convairs');
    }
};
