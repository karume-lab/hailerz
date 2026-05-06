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
        Schema::create('posts', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string('title');
            $blueprint->string('slug')->unique();
            $blueprint->string('category');
            $blueprint->string('author')->default('Hailerz Team');
            $blueprint->string('image_url')->nullable();
            $blueprint->text('subtitle')->nullable();
            $blueprint->json('content');
            $blueprint->boolean('is_published')->default(true);
            $blueprint->timestamp('published_at')->nullable();
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
