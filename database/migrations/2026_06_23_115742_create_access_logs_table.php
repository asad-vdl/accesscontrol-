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
        Schema::create('access_logs', function (Blueprint $table) {

            $table->id();

            // Kis user ne access kiya
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained()
                  ->onDelete('set null');

            // Kis device se access hua
            $table->foreignId('device_id')
                  ->nullable()
                  ->constrained()
                  ->onDelete('set null');


            // Credential type
            // card, fingerprint, face etc
            $table->string('credential_type');


            // Credential value
            $table->string('credential_value')
                  ->nullable();


            // Gate Result
            // granted / denied
            $table->enum('access_status', [
                'granted',
                'denied'
            ]);


            // Optional details
            $table->text('remarks')
                  ->nullable();


            $table->timestamps();

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('access_logs');
    }
};
