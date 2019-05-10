<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('verification_code', 36);
            $table->timestamp('verification_expire')->nullable();
            $table->boolean('is_verified')->default('0');
            $table->string('profile_img_path')->nullable();
            $table->string('password_reset_token', 36)->nullable();
            $table->string('contact_no')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // Insert default user record
        DB::table('user')->insert([
                array('first_name' => 'HaShaN', 'last_name' => 'Sandeepa', 'email' => 'hashans95@gmail.com',
                    'verification_code' => 'b5d4ee43323240f29968627fc20a9c78', 'is_verified' => 1,
                    'contact_no' => '0718761179', 'username' => 'HaShaN',
                    'password' => '$2y$10$hPUuG7/1JH5.JypLiXPAreWKJArKu07mpgVVcc8IiLZYmZ3mQlU0W')
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
