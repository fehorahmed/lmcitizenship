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
        Schema::create('warish_settings', function (Blueprint $table) {
            $table->id();

            $table->double('rate', 10, 2);
            $table->double('dc_rate', 10, 2)->nullable();
            $table->text('profiel_require')->nullable();
            $table->text('singtur_one_text')->nullable();
            $table->text('singtur_one_img')->nullable();
            $table->text('singtur_two_text')->nullable();
            $table->text('singtur_two_img')->nullable();
            // $table->longText('welcomepage')->nullable();

            // Hasan Defaul coulmns
            $table->string('remarks')->nullable();
            // $table->integer('sort_by')->nullable();
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
        Schema::dropIfExists('warish_settings');
    }
};
