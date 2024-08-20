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
        Schema::create('t_requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_group')->nullable();
            $table->string('reference')->unique();
            $table->longText('memo')->nullable();
            $table->float('estimation')->nullable();
            $table->enum('status', ['init', 'estimated', 'accepted', 'in_progress', 'completed', 'canceled'])->default('init');
            $table->foreignId('car_id')->constrained('t_cars');
            $table->nullableMorphs('created_by');
            $table->integer('finish_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_requests');
    }
};
