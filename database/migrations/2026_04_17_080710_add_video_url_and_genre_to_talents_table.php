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
        Schema::table('talents', function (Blueprint $table) {
            if (!Schema::hasColumn('talents', 'genre')) {
                $table->string('genre')->nullable()->after('category_id');
            }
            if (!Schema::hasColumn('talents', 'video_url')) {
                $table->string('video_url')->nullable()->after('technical_rider');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('talents', function (Blueprint $table) {
            $table->dropColumn(['genre', 'video_url']);
        });
    }
};
