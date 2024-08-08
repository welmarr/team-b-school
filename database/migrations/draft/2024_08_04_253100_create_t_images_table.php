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
        Schema::create('t_images', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('path');
            $table->string('mime_type');
            $table->string('size');
            $table->string('extension');
            $table->string('public_uri')->nullable()->unique();
            $table->string('folder')->nullable();
            $table->enum('take_when', ['AfterWork','BeforeWork', 'DuringWork'])->default('BeforeWork');

            $table->foreignId('request_id')->constrained('t_requests');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_images');
    }
};
