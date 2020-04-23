<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitalModalityPivotTable extends Migration
{
    public function up()
    {
        Schema::create('hospital_modality', function (Blueprint $table) {
            $table->unsignedInteger('hospital_id');
            $table->foreign('hospital_id', 'hospital_id_fk_1363481')->references('id')->on('hospitals')->onDelete('cascade');
            $table->unsignedInteger('modality_id');
            $table->foreign('modality_id', 'modality_id_fk_1363481')->references('id')->on('modalities')->onDelete('cascade');
        });

    }
}
