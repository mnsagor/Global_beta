<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('gender')->nullable();
            $table->date('dof')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('nid')->nullable();
            $table->longText('clinical_history')->nullable();
            $table->longText('surgical_history')->nullable();
            $table->string('lab_results')->nullable();
            $table->longText('deo_comments')->nullable();
            $table->longText('clinical_diagnosis')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

    }
}
