<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gates', function (Blueprint $table) {

            $table->id();

            // Gate Name
            $table->string('name');

            // Unique Gate Code
            $table->string('gate_code')->unique();

            // Location
            $table->string('location')->nullable();

            // Status
            $table->boolean('status')->default(1);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gates');
    }
};