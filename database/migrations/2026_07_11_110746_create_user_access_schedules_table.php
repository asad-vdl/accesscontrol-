<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_access_schedules', function (Blueprint $table) {

            $table->id();

            // User
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Allowed Days
            $table->boolean('monday')->default(true);
            $table->boolean('tuesday')->default(true);
            $table->boolean('wednesday')->default(true);
            $table->boolean('thursday')->default(true);
            $table->boolean('friday')->default(true);
            $table->boolean('saturday')->default(false);
            $table->boolean('sunday')->default(false);

            // Time
            $table->time('start_time')->default('08:00:00');
            $table->time('end_time')->default('18:00:00');

            // Validity
            $table->date('valid_from')->nullable();
            $table->date('valid_to')->nullable();

            // Status
            $table->boolean('status')->default(true);

            $table->timestamps();

            $table->unique('user_id');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_access_schedules');
    }
};