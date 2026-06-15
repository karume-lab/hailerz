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
        if (! Schema::hasTable('events')) {
            Schema::create('events', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->dateTime('date');
                $table->longText('description');
                $table->string('location');
                $table->decimal('exhibitor_price', 10, 2)->default(350000.00);
                $table->decimal('attendee_price', 10, 2)->default(0.00);
                $table->json('demographics')->nullable();
                $table->json('universities')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
