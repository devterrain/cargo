<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
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
        Schema::create('loaders', function (Blueprint $table) {
            $table->id();
            $table->string('loader_num', 100);
            $table->string('equipment_type', 35);
            $table->string('type', 35)->nullable();
            $table->string('model', 40)->nullable();
            $table->text('loader_notes')->nullable();
            $table->foreignId('shiping_contractor_id')->constrained('shiping_contractors');
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
        Schema::dropIfExists('loaders');
    }
};
