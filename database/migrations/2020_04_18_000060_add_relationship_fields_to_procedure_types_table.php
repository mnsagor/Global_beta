<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProcedureTypesTable extends Migration
{
    public function up()
    {
        Schema::table('procedure_types', function (Blueprint $table) {
            $table->unsignedInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_1271658')->references('id')->on('users');
        });

    }
}
