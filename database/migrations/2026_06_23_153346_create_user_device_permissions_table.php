<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {
        Schema::create('user_device_permissions', function (Blueprint $table) {

            $table->id();


            // User
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();


            // Device / Door
            $table->foreignId('device_id')
                  ->constrained()
                  ->cascadeOnDelete();


            // Permission status
            $table->boolean('access_allowed')
                  ->default(1);


            $table->timestamps();

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('user_device_permissions');
    }

};