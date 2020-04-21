<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitalRolePivotTable extends Migration
{
    public function up()
    {
        Schema::create('hospital_role', function (Blueprint $table) {
            $table->unsignedInteger('hospital_id');
            $table->foreign('hospital_id', 'hospital_id_fk_1353281')->references('id')->on('hospitals')->onDelete('cascade');
            $table->unsignedInteger('role_id');
            $table->foreign('role_id', 'role_id_fk_1353281')->references('id')->on('roles')->onDelete('cascade');
        });

    }
}
