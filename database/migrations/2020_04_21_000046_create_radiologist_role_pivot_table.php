<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRadiologistRolePivotTable extends Migration
{
    public function up()
    {
        Schema::create('radiologist_role', function (Blueprint $table) {
            $table->unsignedInteger('radiologist_id');
            $table->foreign('radiologist_id', 'radiologist_id_fk_1353151')->references('id')->on('radiologists')->onDelete('cascade');
            $table->unsignedInteger('role_id');
            $table->foreign('role_id', 'role_id_fk_1353151')->references('id')->on('roles')->onDelete('cascade');
        });

    }
}
