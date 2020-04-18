<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToWorkOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('work_orders', function (Blueprint $table) {
            $table->unsignedInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_1319619')->references('id')->on('users');
            $table->unsignedInteger('work_order_status_id');
            $table->foreign('work_order_status_id', 'work_order_status_fk_1319814')->references('id')->on('work_order_statuses');
            $table->unsignedInteger('uploaded_by_id');
            $table->foreign('uploaded_by_id', 'uploaded_by_fk_1319815')->references('id')->on('users');
            $table->unsignedInteger('hospital_id');
            $table->foreign('hospital_id', 'hospital_fk_1319817')->references('id')->on('hospitals');
            $table->unsignedInteger('doctor_id');
            $table->foreign('doctor_id', 'doctor_fk_1319818')->references('id')->on('doctors');
            $table->unsignedInteger('patient_id');
            $table->foreign('patient_id', 'patient_fk_1319819')->references('id')->on('patients');
            $table->unsignedInteger('modality_id')->nullable();
            $table->foreign('modality_id', 'modality_fk_1319820')->references('id')->on('modalities');
            $table->unsignedInteger('radiologist_id')->nullable();
            $table->foreign('radiologist_id', 'radiologist_fk_1319822')->references('id')->on('radiologists');
        });

    }
}
