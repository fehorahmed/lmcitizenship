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
        Schema::create('warishes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->tinyInteger('qty')->nullable();
            $table->string('name');
            $table->string('father')->nullable();
            $table->string('mother')->nullable();
            $table->string('application_name')->nullable();
            $table->string('application_relation')->nullable();
            $table->string('application_address')->nullable();
            $table->string('death_certificate')->nullable();
            $table->date('date_of_death')->nullable();

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

            $table->enum('is_editable', ['Yes', 'No'])->default('Yes');

            // Hasan Defaul coulmns
            $table->string('remarks')->nullable();
            $table->integer('sort_by')->nullable();
            $table->enum('is_active', ['Yes', 'No'])->default('Yes');

            $table->foreignId('create_by')->unsigned()->nullable();
            $table->foreign('create_by')->references('id')->on('users');

            $table->foreignId('modified_by')->unsigned()->nullable();
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
        Schema::dropIfExists('warishes');
    }
};
