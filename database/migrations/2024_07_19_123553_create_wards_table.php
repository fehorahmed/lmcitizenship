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
        Schema::create('wards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('union_id');
            $table->foreign('union_id')->references('id')->on('unions');
            $table->string('name');
            $table->string('bn_name')->nullable();
            $table->string('commissioner_name')->nullable();
            $table->string('commissioner_signature')->nullable();
            $table->string('commissioner_phone')->nullable();
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
        Schema::dropIfExists('wards');
    }
};
