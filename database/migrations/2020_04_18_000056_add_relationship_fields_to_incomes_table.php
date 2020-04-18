<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToIncomesTable extends Migration
{
    public function up()
    {
        Schema::table('incomes', function (Blueprint $table) {
            $table->unsignedInteger('income_category_id')->nullable();
            $table->foreign('income_category_id', 'income_category_fk_1313022')->references('id')->on('income_categories');
        });

    }
}
