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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('driver_name')->unique();
            $table->string('province', 50)->nullable();;
            $table->string('city', 50)->nullable();;
            $table->string('driver_address')->nullable();
            $table->date('driver_birthday')->nullable();
            $table->string('licence_type', 30)->nullable();
            $table->bigInteger('licence_num')->unique();
            $table->bigInteger('identity_num')->unique();
            $table->date('hiring_date')->nullable();
            $table->bigInteger('driver_code');
            $table->foreignId('contractor_id')->constrained('contractors');
            $table->foreignId('user_id')->constrained('users');
            $table->text('driver_notes')->nullable();
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
        Schema::dropIfExists('drivers');
    }
};
