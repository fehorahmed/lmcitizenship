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
        Schema::create('home_contacts', function (Blueprint $table) {
            $table->id();
            $table->string('designation');
            $table->string('address');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->boolean('status')->default(1);
            $table->foreignId('created_by');
            $table->foreign('created_by')->on('users')->references('id');

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
        Schema::dropIfExists('home_contacts');
    }
};
