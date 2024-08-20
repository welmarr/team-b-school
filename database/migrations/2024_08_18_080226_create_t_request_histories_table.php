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
        Schema::create('t_request_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained('t_requests');
            $table->enum('status', ['init','estimated', 'accepted', 'in_progress', 'completed', 'canceled'])->default('init');
            $table->json('data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_request_histories');
    }
};
