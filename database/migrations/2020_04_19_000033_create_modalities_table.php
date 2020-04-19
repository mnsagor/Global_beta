<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModalitiesTable extends Migration
{
    public function up()
    {
        Schema::create('modalities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->longText('details')->nullable();
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });

    }
}
