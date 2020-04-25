<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModalityRadiologistPivotTable extends Migration
{
    public function up()
    {
        Schema::create('modality_radiologist', function (Blueprint $table) {
            $table->unsignedInteger('radiologist_id');
            $table->foreign('radiologist_id', 'radiologist_id_fk_1278704')->references('id')->on('radiologists')->onDelete('cascade');
            $table->unsignedInteger('modality_id');
            $table->foreign('modality_id', 'modality_id_fk_1278704')->references('id')->on('modalities')->onDelete('cascade');
        });

    }
}
