<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcedureWorkOrderPivotTable extends Migration
{
    public function up()
    {
        Schema::create('procedure_work_order', function (Blueprint $table) {
            $table->unsignedInteger('work_order_id');
            $table->foreign('work_order_id', 'work_order_id_fk_1319821')->references('id')->on('work_orders')->onDelete('cascade');
            $table->unsignedInteger('procedure_id');
            $table->foreign('procedure_id', 'procedure_id_fk_1319821')->references('id')->on('procedures')->onDelete('cascade');
        });

    }
}
