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
        Schema::create('t_tool_inventory_movements', function (Blueprint $table) {
            $table->id();
            $table->float('quantity')->nullable();
            $table->longText('note')->nullable();
            $table->enum('type', ['Added','Used', 'Scraped']);
            $table->foreignId('tool_id')->constrained('t_tools');
            $table->foreignId('request_id')->nullable()->constrained('t_requests')->onDelete('SET NULL');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_tool_inventory_movements');
    }
};
