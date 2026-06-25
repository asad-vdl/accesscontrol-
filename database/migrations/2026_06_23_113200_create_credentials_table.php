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
        Schema::create('credentials', function (Blueprint $table) {

            $table->id();

            // User Reference
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            // card / pin / fingerprint / palm / face
            $table->string('credential_type');

            // Actual Value
            $table->string('credential_value')->unique();

            // Active / Inactive
            $table->boolean('status')->default(1);

            // Notes
            $table->text('notes')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credentials');
    }
};