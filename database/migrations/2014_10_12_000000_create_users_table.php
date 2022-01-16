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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('password');
            $table->string('email')->unique();
            $table->string('gender')->default('Nam');
            $table->string('phone')->nullable();
            $table->string('avatar')->default('https://res.cloudinary.com/quankiu/image/upload/v1642293644/qha_shop/avatar-mac-dinh_gpvsiv.png');
            $table->string('address')->nullable();
            $table->date('birthday')->nullable();
            $table->boolean('status')->default(true);
            $table->json('liked')->nullable();
            $table->unsignedBigInteger('user_type_id')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
