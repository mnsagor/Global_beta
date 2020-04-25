<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRadiologistsTable extends Migration
{
    public function up()
    {
        Schema::create('radiologists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone_number')->nullable();
            $table->longText('address')->nullable();
            $table->string('designation')->nullable();
            $table->string('gender');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });

    }
}
