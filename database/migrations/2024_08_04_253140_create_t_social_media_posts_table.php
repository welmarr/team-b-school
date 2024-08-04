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
        Schema::create('t_social_media_posts', function (Blueprint $table) {
            $table->id();
            $table->longText('message');
            $table->json('api_return')->nullable();
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
        Schema::dropIfExists('t_social_media_posts');
    }
};
