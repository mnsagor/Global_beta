<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitalRadiologistPivotTable extends Migration
{
    public function up()
    {
        Schema::create('hospital_radiologist', function (Blueprint $table) {
            $table->unsignedInteger('radiologist_id');
            $table->foreign('radiologist_id', 'radiologist_id_fk_1278702')->references('id')->on('radiologists')->onDelete('cascade');
            $table->unsignedInteger('hospital_id');
            $table->foreign('hospital_id', 'hospital_id_fk_1278702')->references('id')->on('hospitals')->onDelete('cascade');
        });

    }
}
