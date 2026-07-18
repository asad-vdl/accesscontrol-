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
    Schema::create('settings', function (Blueprint $table) {

        $table->id();

        $table->string('company_name')->default('Smart Access Control');

        $table->string('company_logo')->nullable();

        $table->string('timezone')->default('Asia/Riyadh');

        $table->integer('door_unlock_time')->default(5);

        $table->boolean('voice_enabled')->default(true);

        $table->boolean('hardware_enabled')->default(false);

        $table->timestamps();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
