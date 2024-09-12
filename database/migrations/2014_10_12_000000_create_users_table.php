<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();

            $table->string('father_name')->nullable();
            $table->string('husband_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('nid')->nullable();
            $table->string('nid_file')->nullable();
            $table->string('profession')->nullable();
            $table->string('designation')->nullable();
            $table->string('signature')->nullable();
            $table->boolean('freedomfighters')->nullable();
            $table->string('birth_certificate_no')->nullable();
            $table->string('birth_certificate_file')->nullable();
            $table->string('gender')->nullable();
            $table->foreignId('religion')->nullable();
            $table->string('marital_status')->nullable();
            $table->boolean('user_type')->default(1)->comment('স্থায়ী বাসিন্দা নাকি অস্থায়ী বাসিন্দা');
            //Present
            $table->foreignId('commissioner_ward_id')->nullable();
            $table->foreignId('division_id')->nullable();
            $table->foreignId('district_id')->nullable();
            $table->foreignId('sub_district_id')->nullable();
            $table->foreignId('union_id')->nullable();
            $table->foreignId('ward_id')->nullable();
            $table->foreignId('moholla_id')->nullable();
            $table->foreignId('post_office_id')->nullable();
            $table->string('address')->nullable();
            //Permanent
            $table->foreignId('per_division_id')->nullable();
            $table->foreignId('per_district_id')->nullable();
            $table->foreignId('per_sub_district_id')->nullable();
            $table->foreignId('per_union_id')->nullable();
            $table->foreignId('per_ward_id')->nullable();
            $table->foreignId('per_moholla_id')->nullable();
            $table->foreignId('per_post_office_id')->nullable();
            $table->string('per_address')->nullable();
            //Office Address
            $table->string('off_phone')->nullable();
            $table->foreignId('off_division_id')->nullable();
            $table->foreignId('off_district_id')->nullable();
            $table->string('off_address')->nullable();

            $table->tinyInteger('role')->default(1)->comment('1=user, 2=Admin, 3= Super Admin');
            $table->foreignId('created_by')->nullable();
            $table->boolean('status')->default(1);
            $table->enum('registration_status', ['Pending', 'Approved', 'Cancel'])->nullable();
            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::table('users')->insert([

            array(
                'id' => '1', 'name' => 'Super Admin', 'email' => 'admin@gmail.com',
                'phone' => '01750637286',
                'password' => Hash::make('password'),
                'role' => 3
            ),

        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
