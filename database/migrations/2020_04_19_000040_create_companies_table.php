<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->string('email')->nullable();
            $table->longText('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('web_address')->nullable();
            $table->string('fb_address')->nullable();
            $table->longText('notice')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

    }
}
