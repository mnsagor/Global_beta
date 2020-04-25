<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToWorkOrderStatusesTable extends Migration
{
    public function up()
    {
        Schema::table('work_order_statuses', function (Blueprint $table) {
            $table->unsignedInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_1319657')->references('id')->on('users');
        });

    }
}
