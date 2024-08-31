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
        Schema::create('t_tools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->boolean('track_usage')->default(true);
            $table->integer('condition')->nullable();
            $table->timestamp('enable_tracking_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreignId('tool_type_id')->constrained('t_tool_types');
            $table->foreignId('unit_id')->constrained('t_units');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_tools');
    }
};
