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
        Schema::create('citizenships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreignId('dc_id')->nullable();
            $table->foreign('dc_id')->references('id')->on('users');

            $table->string('name');
            $table->string('father')->nullable();
            $table->string('husband')->nullable();
            $table->string('mother')->nullable();
            $table->string('bc_no')->nullable();
            $table->string('nid')->nullable();
            $table->boolean('user_type')->default(1)->comment('স্থায়ী বাসিন্দা নাকি অস্থায়ী বাসিন্দা');

            $table->foreignId('division_id')->nullable();
            $table->foreignId('district_id')->nullable();
            $table->foreignId('upazila_id')->nullable();
            $table->foreignId('union_id')->nullable();
            $table->foreignId('ward_id')->nullable();
            $table->foreignId('moholla_id')->nullable();
            $table->foreignId('post_office_id')->nullable();

            $table->foreign('division_id')->references('id')->on('divisions');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('upazila_id')->references('id')->on('upazilas');
            $table->foreign('union_id')->references('id')->on('unions');
            $table->foreign('ward_id')->references('id')->on('wards');
            $table->foreign('moholla_id')->references('id')->on('mohollas');
            $table->string('address')->nullable();

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
            $table->boolean('digital_status')->default(0)->comment('Digital user approved or not');
            $table->boolean('commissioner_status')->default(0);
            $table->enum('status', ['Pending', 'Approved', 'Modification', 'Canceled'])->default('Pending');

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
        Schema::dropIfExists('citizenships');
    }
};
