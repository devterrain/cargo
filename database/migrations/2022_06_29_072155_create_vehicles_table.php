<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;
use PHPUnit\Framework\Constraint\Constraint;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('type', 20);
            $table->string('model', 50)->nullable();
            $table->string('manufacturer', 50)->nullable();
            $table->string('plate_num', 35)->unique();
            $table->string('chasset_num',50)->nullable();
            $table->string('engine_num', 50)->nullable();
            $table->date('entry_date')->nullable();
            $table->foreignId('contractor_id')->constrained('contractors');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
};
