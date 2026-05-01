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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('talent_id')->nullable()->constrained('talents')->nullOnDelete();
            
            // Contact Information
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('company')->nullable();

            // Event Details
            $table->string('event_type');
            $table->date('event_date');
            $table->string('event_time')->nullable();
            $table->string('performance_duration')->nullable();
            $table->string('venue_name')->nullable();
            $table->string('city');
            $table->string('state');
            $table->integer('expected_guests');

            // Talent Preferences
            $table->string('talent_category');
            $table->string('preferred_genre')->nullable();
            $table->string('budget_range')->nullable();
            $table->string('specific_talent')->nullable();
            $table->text('additional_details');

            // Misc
            $table->string('source')->nullable(); // How did you hear about us?

            $table->string('status')->default('new'); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
