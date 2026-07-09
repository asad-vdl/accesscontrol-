<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_gate_permissions', function (Blueprint $table) {

            $table->id();

            // User
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Gate
            $table->foreignId('gate_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Permission
            $table->boolean('access_allowed')
                  ->default(true);

            $table->timestamps();

            $table->unique([
                'user_id',
                'gate_id'
            ]);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_gate_permissions');
    }
};