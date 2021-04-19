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
            $table->string('name');
            $table->string('username ');
            $table->string('email  ');
            $table->text('about  ');
            $table->date('birth_date  ');
            $table->tinyInteger('gender  ');
            $table->tinyInteger('verified  ');
            $table->timestamps('email_verified_at');
            $table->string('password  ');
            $table->string('remember_token  ');
            $table->timestamps();
            $table->tinyInteger('is_admin  ');

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
