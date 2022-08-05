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
        Schema::create('policy_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('policy_id')->constrained('policies')->onDelete('cascade');
            $table->foreignId('store_id')->nullable()->constrained('stores');
            $table->foreignId('shiptrip_id')->nullable()->constrained('ship_trips');
            $table->foreignId('release_id')->nullable()->constrained('releases');
            $table->integer('dloaded_weight')->nullable();
            $table->timestamp('first_scale')->nullable();
            $table->integer('dempty_weight')->nullable();
            $table->integer('dnet_weight')->nullable();
            $table->timestamp('second_scale')->nullable();
            $table->timestamp('unload_start')->nullable();
            $table->timestamp('unload_end')->nullable();
            $table->text('scale_notes')->nullable();
            $table->text('unload_notes')->nullable();
            $table->text('other_notes')->nullable();
            $table->foreignId('scale1_user_id')->nullable()->constrained('users');
            $table->foreignId('scale2_user_id')->nullable()->constrained('users');
            $table->foreignId('shipping1_user_id')->nullable()->constrained('users');
            $table->foreignId('shipping2_user_id')->nullable()->constrained('users');
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
        Schema::dropIfExists('policy_details');
    }
};
