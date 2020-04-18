<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('designation')->nullable();
            $table->string('specilities')->nullable();
            $table->string('department')->nullable();
            $table->string('nid')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone_number');
            $table->string('email')->nullable();
            $table->string('status')->nullable();
            $table->longText('address')->nullable();
            $table->longText('special_achievement')->nullable();
            $table->longText('history')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

    }
}
