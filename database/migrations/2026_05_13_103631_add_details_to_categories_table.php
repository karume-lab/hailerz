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
        Schema::table('categories', function (Blueprint $table) {
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->string('typical_pricing')->nullable();
            $table->json('popular_genres')->nullable();
            $table->string('popular_for')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['description', 'icon', 'typical_pricing', 'popular_genres', 'popular_for']);
        });
    }
};
