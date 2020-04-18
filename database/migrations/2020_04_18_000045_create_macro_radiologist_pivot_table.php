<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMacroRadiologistPivotTable extends Migration
{
    public function up()
    {
        Schema::create('macro_radiologist', function (Blueprint $table) {
            $table->unsignedInteger('radiologist_id');
            $table->foreign('radiologist_id', 'radiologist_id_fk_1278771')->references('id')->on('radiologists')->onDelete('cascade');
            $table->unsignedInteger('macro_id');
            $table->foreign('macro_id', 'macro_id_fk_1278771')->references('id')->on('macros')->onDelete('cascade');
        });

    }
}
