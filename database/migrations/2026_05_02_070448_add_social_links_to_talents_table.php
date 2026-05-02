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
            $table->string('website_url')->nullable();
            $table->string('instagram_handle')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('youtube_channel')->nullable();
            $table->string('tiktok_handle')->nullable();
            $table->string('years_active')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('talents', function (Blueprint $table) {
            //
        });
    }
};
