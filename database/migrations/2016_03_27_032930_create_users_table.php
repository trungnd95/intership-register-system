<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('user_name');
            $table->string('full_name');
            $table->string('email');
            $table->string('password');
            $table->integer('student_code');
            $table->string('class_name');
            $table->date('birth_day');
            $table->string('phone_number');
            $table->string('avatar');
            $table->boolean('confirmed');
            $table->string('confirmation_code');
//            $table->enum('teacher_acceptance',['accepted','pending','ignore']);
            $table->integer('teacher_id')->unsigned();
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
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
        Schema::drop('users');
    }
}
