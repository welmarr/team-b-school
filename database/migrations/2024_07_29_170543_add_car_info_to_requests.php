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
        Schema::table('requests', function (Blueprint $table) {
            $table->year('year')->nullable();
            $table->foreignId('make_id')->nullable()->constrained('car_makes')->onDelete('SET NULL');
            $table->foreignId('model_id')->nullable()->constrained('car_models')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('requests', function (Blueprint $table) {
            $table->dropForeign(['year', 'make_id', 'model_id']);
        });
    }
};
