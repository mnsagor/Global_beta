<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProceduresTable extends Migration
{
    public function up()
    {
        Schema::table('procedures', function (Blueprint $table) {
            $table->unsignedInteger('modality_id');
            $table->foreign('modality_id', 'modality_fk_1271648')->references('id')->on('modalities');
            $table->unsignedInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_1271652')->references('id')->on('users');
            $table->unsignedInteger('procedure_type_id');
            $table->foreign('procedure_type_id', 'procedure_type_fk_1271659')->references('id')->on('procedure_types');
        });

    }
}
