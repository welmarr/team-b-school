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
        Schema::create('tool_inventory_movements', function (Blueprint $table) {
            $table->id();
            $table->string('movement_type_detail')->nullable();
            $table->float('quantity');
            $table->longText('note')->nullable();

            $table->foreignId('tool_id')->constrained('tools')->nullable()->cascadeOnDelete();
            $table->foreignId('file_id')->constrained('files')->nullable()->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tool_inventory_movements');
    }
};
