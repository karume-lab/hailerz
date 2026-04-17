<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->string('location')->nullable();
            $table->string('genre')->nullable();
            $table->string('category')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('spotify_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->text('bio')->nullable();
            $table->integer('years_experience')->nullable();
            $table->string('minimum_fee')->nullable();
            $table->boolean('has_management')->default(false);
            $table->string('management_contact')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropColumn([
                'phone', 'location', 'genre', 'category',
                'instagram_url', 'spotify_url', 'youtube_url',
                'bio', 'years_experience', 'minimum_fee',
                'has_management', 'management_contact',
            ]);
        });
    }
};
