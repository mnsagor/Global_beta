<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMacrosTable extends Migration
{
    public function up()
    {
        Schema::table('macros', function (Blueprint $table) {
            $table->unsignedInteger('modality_id');
            $table->foreign('modality_id', 'modality_fk_1271701')->references('id')->on('modalities');
            $table->unsignedInteger('procedure_id');
            $table->foreign('procedure_id', 'procedure_fk_1271702')->references('id')->on('procedures');
            $table->unsignedInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_1271708')->references('id')->on('users');
        });

    }
}
