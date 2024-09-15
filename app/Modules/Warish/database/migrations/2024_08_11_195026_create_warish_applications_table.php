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
        Schema::create('warish_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreignId('warish_id');
            $table->foreign('warish_id')->references('id')->on('warishes');
            $table->foreignId('dc_id')->nullable();
            $table->foreign('dc_id')->references('id')->on('users');

            $table->string('payment_method');
            $table->double('amount', 10, 2)->nullable();
            $table->double('rate', 10, 2)->nullable();
            $table->double('dc_rate', 10, 2)->nullable();
            $table->text('payment_info')->nullable();
            $table->date('payment_date')->nullable();
            $table->string('nid_info')->nullable();
            $table->string('citizenship_info')->nullable();
            $table->text('nid_file')->nullable();
            $table->text('citizenship_file')->nullable();
            $table->text('photo_file')->nullable();
            $table->enum('status', ['Pending', 'Approved', 'Modification', 'Canceled'])->default('Pending');

            // Hasan Defaul coulmns
            $table->string('remarks')->nullable();
            $table->integer('sort_by')->nullable();
            $table->enum('is_active', ['Yes', 'No'])->default('Yes');

            $table->boolean('digital_status')->default(0)->comment('Digital user approved or not');
            $table->boolean('commissioner_status')->default(0);

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
        Schema::dropIfExists('warish_applications');
    }
};
