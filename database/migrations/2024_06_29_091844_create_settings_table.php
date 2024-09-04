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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('App Name');
            $table->string('logo')->nullable();
            $table->string('banner')->nullable();
            $table->string('mayor_signature')->nullable();
            $table->string('mayor_name')->nullable();
            $table->text('map')->nullable();
            $table->string('headerurl')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('facebook_page_url')->nullable();
            $table->string('favicon')->nullable();
            $table->string('timezone')->nullable();
            $table->string('road')->nullable();
            $table->string('ward_no')->nullable();
            $table->string('post_office')->nullable();
            $table->string('upazilla')->nullable();
            $table->string('district')->nullable();
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
        Schema::dropIfExists('settings');
    }
};
