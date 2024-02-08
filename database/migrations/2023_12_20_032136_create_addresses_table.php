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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->nullable(false);
            $table->string('name')->nullable(false);
            $table->integer('telephone_number')->nullable(false);
            $table->integer('post_code')->nullable(false);
            $table->string('prefectures')->nullable(false);
            $table->string('municipalities')->nullable(false);
            $table->string('street_address');
            $table->string('building');
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
        Schema::dropIfExists('addresses');
    }
};
