<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('devices', function (Blueprint $table) {


            $table->id();


            // Device name
            $table->string('name');


            // RFID, Fingerprint, Palm, Face etc.
            $table->string('type');



            // Unique device identification
            $table->string('device_code')
                  ->unique();



            // Device IP Address
            $table->string('ip_address')
                  ->nullable();



            // Installation place
            $table->string('location')
                  ->nullable();



            // Active / Inactive
            $table->boolean('status')
                  ->default(1);


            $table->timestamps();


        });

    }




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('devices');

    }

};