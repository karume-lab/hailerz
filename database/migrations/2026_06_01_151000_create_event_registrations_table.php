<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('pass_type'); // attendee, exhibitor
            $table->string('company_name')->nullable();
            $table->text('company_description')->nullable();
            $table->longText('company_logo')->nullable(); // Store inline base64 WebP brand asset
            $table->decimal('total_amount', 10, 2)->default(0.00);
            $table->string('payment_status')->default('pending'); // pending, confirmed
            $table->string('payment_reference')->nullable()->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
    }
};
