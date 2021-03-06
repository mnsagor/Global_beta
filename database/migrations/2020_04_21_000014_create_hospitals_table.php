<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitalsTable extends Migration
{
    public function up()
    {
        Schema::create('hospitals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->string('hospital_code')->nullable();
            $table->longText('address')->nullable();
            $table->string('manager_name')->nullable();
            $table->string('manager_phone_number')->nullable();
            $table->string('techonologist_name')->nullable();
            $table->string('technologist_phone_number')->nullable();
            $table->string('receptionist_name')->nullable();
            $table->string('receptionist_phone_number')->nullable();
            $table->string('route_title')->nullable();
            $table->string('route_ae_title')->nullable();
            $table->string('route_host_name')->nullable();
            $table->string('route_port')->nullable();
            $table->string('pacs_destinaiton_ae_title')->nullable();
            $table->string('pacs_ae_title')->nullable();
            $table->string('pacs_host_name')->nullable();
            $table->string('pacs_port')->nullable();
            $table->string('status');
            $table->string('proprietor_name')->nullable();
            $table->string('proprietor_phone_number')->nullable();
            $table->string('chairman_name')->nullable();
            $table->string('chairman_phone_number')->nullable();
            $table->string('director_name')->nullable();
            $table->string('director_phone_number')->nullable();
            $table->string('accountant_name')->nullable();
            $table->string('accountant_phone_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

    }
}
