<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('challenges', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('banner_image')->nullable();
            $table->longText('description');
            $table->decimal('prize_pool', 12, 2)->default(0.00);
            $table->dateTime('start_date')->index();
            $table->dateTime('end_date')->index();
            $table->timestamps();
        });

        Schema::create('challenge_interactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('challenge_id')->constrained()->cascadeOnDelete();
            $table->string('type')->default('like');
            $table->timestamps();

            $table->unique(['user_id', 'challenge_id', 'type']);
        });

        Schema::create('challenge_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('challenge_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->text('body');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('challenge_comments');
        Schema::dropIfExists('challenge_interactions');
        Schema::dropIfExists('challenges');
    }
};
