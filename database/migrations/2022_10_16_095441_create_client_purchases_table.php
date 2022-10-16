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
        Schema::create('client_purchases', function (Blueprint $table) {
            $table->id();
            $table->string('plan')->nullable();
            $table->date('package_exp')->nullable();
            $table->string('package_price')->nullable();
            $table->string('package_2_type')->nullable();
            $table->string('package_3_type')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('service_id')->nullable();
            $table->integer('account_id')->nullable();
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
        Schema::dropIfExists('client_purchases');
    }
};
