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
        Schema::create('t_appointments', function (Blueprint $table) {
            $table->id();
            $table->timestamp('appointment_date');
            $table->boolean('is_current')->default(true);
            $table->softDeletes();
            $table->timestamps();
            $table->foreignId('request_id')->constrained('t_requests');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_appointments');
    }
};
