<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTransactionsTable extends Migration
{
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->unsignedInteger('project_id')->nullable();
            $table->foreign('project_id', 'project_fk_1312992')->references('id')->on('projects');
            $table->unsignedInteger('transaction_type_id')->nullable();
            $table->foreign('transaction_type_id', 'transaction_type_fk_1312993')->references('id')->on('transaction_types');
            $table->unsignedInteger('income_source_id')->nullable();
            $table->foreign('income_source_id', 'income_source_fk_1312994')->references('id')->on('income_sources');
            $table->unsignedInteger('currency_id')->nullable();
            $table->foreign('currency_id', 'currency_fk_1312996')->references('id')->on('currencies');
        });

    }
}
