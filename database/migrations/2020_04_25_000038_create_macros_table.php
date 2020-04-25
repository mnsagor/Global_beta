<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMacrosTable extends Migration
{
    public function up()
    {
        Schema::create('macros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->longText('details');
            $table->string('title');
            $table->timestamps();
            $table->softDeletes();
        });

    }
}
