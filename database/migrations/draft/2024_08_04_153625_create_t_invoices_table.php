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
        Schema::create('t_invoices', function (Blueprint $table) {
            $table->id();
            $table->float('amount');
            $table->boolean('is_paid')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('request_id')->constrained('t_requests');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_invoices');
    }
};
