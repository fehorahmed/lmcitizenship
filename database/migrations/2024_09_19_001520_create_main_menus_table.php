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
        Schema::create('main_menus', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['main','sub']);
            $table->enum('position',['header','footer'])->default('header');
            $table->foreignId('main_menu_id')->nullable();
            $table->string('title');
            $table->string('url');
            $table->longText('content')->nullable();
            $table->unsignedTinyInteger('order')->default(1);
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('main_menus');
    }
};
