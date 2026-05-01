<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            // Artist Information
            $table->string('artist_name');
            $table->string('real_name');
            $table->string('email');
            $table->string('phone');
            $table->string('location'); // City, State
            $table->string('profile_photo_url');

            // Professional Details
            $table->string('category');
            $table->string('genre')->nullable();
            $table->string('years_active');
            $table->decimal('min_rate', 12, 2);
            $table->decimal('max_rate', 12, 2);

            // Online Presence
            $table->string('website_url')->nullable();
            $table->string('instagram_handle')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('youtube_channel')->nullable();
            $table->string('tiktok_handle')->nullable();

            // Experience & Credentials
            $table->text('notable_venues')->nullable();
            $table->text('notable_clients')->nullable();
            $table->text('press_features')->nullable();

            // Additional Information
            $table->text('bio');
            $table->text('motivation'); // Why join Hailerz?
            $table->string('source')->nullable(); // How did you hear about us?

            $table->string('status')->default('pending'); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
