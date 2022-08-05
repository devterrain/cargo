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
        Schema::table('policy_details', function (Blueprint $table) {
            $table->foreignId('loader_id')->nullable()->constrained('loaders');
            $table->foreignId('loader_operator_id')->nullable()->constrained('operators');
            $table->foreignId('loader2_id')->nullable()->constrained('loaders');
            $table->foreignId('loader2_operator_id')->nullable()->constrained('operators');
            $table->foreignId('convair_id')->nullable()->constrained('convairs');
            $table->foreignId('convair_operator_id')->nullable()->constrained('operators');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('policy_details', function (Blueprint $table) {
            //
        });
    }
};
