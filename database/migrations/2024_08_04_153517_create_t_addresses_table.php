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
        Schema::create('t_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::table('t_dealerships', function (Blueprint $table) {
            $table->foreignId('address_id')->nullable()->constrained('t_addresses')->onDelete('SET NULL');
        });


        Schema::table('t_clients', function (Blueprint $table) {
            $table->foreignId('address_id')->nullable()->constrained('t_addresses')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_addresses');
    }
};
