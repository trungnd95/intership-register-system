<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_configurations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('time_start');
            $table->string('time_end');
            $table->integer('max_register');
            $table->boolean('send_notify_student');
            $table->boolean('send_notify_teacher');
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
        Schema::drop('admin_configurations');
    }
}
