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
        Schema::create('transaction_logs', function (Blueprint $table) {
            $table->id();
            $table->enum('payment_type',['CITIZENSHIP','WARISH']);
            $table->text('payment_info');
            $table->unsignedFloat('amount',8,2)->default(0);
            $table->date('date');
            $table->foreignId('user_id');
            $table->foreignId('citizenship_id')->nullable();
            $table->foreignId('warish_application_id')->nullable();
            $table->foreign('citizenship_id')->on('citizenships')->references('id');
            $table->foreign('warish_application_id')->on('warish_applications')->references('id');
            $table->enum('is_active',['yes','no'])->default('no');
            $table->boolean('digital_status')->default(0);

            $table->boolean('commissioner_status')->default(0);

            $table->boolean('admin_status')->default(0);
            $table->foreignId('admin_accept_by')->nullable();
            $table->foreign('admin_accept_by')->on('users')->references('id');

            $table->foreignId('digital_accept_by')->nullable();
            $table->foreign('digital_accept_by')->on('users')->references('id');

            $table->foreignId('commissioner_accept_by')->nullable();
            $table->foreign('commissioner_accept_by')->on('users')->references('id');

            $table->foreignId('created_by');
            $table->foreign('created_by')->on('users')->references('id');
            $table->foreign('user_id')->on('users')->references('id');
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
        Schema::dropIfExists('transaction_logs');
    }
};
