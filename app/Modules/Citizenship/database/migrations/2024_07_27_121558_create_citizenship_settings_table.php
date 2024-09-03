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
        Schema::create('citizenship_settings', function (Blueprint $table) {
            $table->id();
            $table->double('rate', 10, 2);
            $table->double('dc_rate', 10, 2)->nullable();
            $table->text('profiel_require')->nullable();
            $table->boolean('is_nid_info')->default(0);
            $table->boolean('is_nid_file')->default(0);
            $table->boolean('is_citizenship_info')->default(0);
            $table->boolean('is_citizenship_file')->default(0);
            $table->boolean('is_photo_file')->default(0);
            $table->text('singtur_one_text')->nullable();
            $table->text('singtur_one_img')->nullable();
            $table->text('singtur_two_text')->nullable();
            $table->text('singtur_two_img')->nullable();

            // Hasan Defaul coulmns
            $table->string('remarks')->nullable();
            $table->integer('sort_by')->nullable();
            $table->enum('is_active', ['Yes', 'No'])->default('Yes');

            $table->foreignId('create_by')->nullable();
            $table->foreign('create_by')->references('id')->on('users');

            $table->foreignId('modified_by')->nullable();
            $table->foreign('modified_by')->references('id')->on('users');
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
        Schema::dropIfExists('citizenship_settings');
    }
};
