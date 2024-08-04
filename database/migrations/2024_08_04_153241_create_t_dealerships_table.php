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
        Schema::create('t_dealerships', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('phone')->nullable();
            $table->foreignId('admin_id')->constrained('users')->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('dealership_id')->nullable()->constrained('t_dealerships')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['dealership_id']);
        });

        Schema::dropIfExists('t_dealerships');
    }
};
