<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserUserAlertPivotTable extends Migration
{
    public function up()
    {
        Schema::create('user_user_alert', function (Blueprint $table) {
            $table->unsignedInteger('user_alert_id');
            $table->foreign('user_alert_id', 'user_alert_id_fk_1271539')->references('id')->on('user_alerts')->onDelete('cascade');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_1271539')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('read')->default(0);
        });

    }
}
