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
        Schema::table('inquiries', function (Blueprint $table) {
            $table->string('client_phone')->nullable();
            $table->string('event_location')->nullable();
            $table->boolean('budget_flexible')->default(false);
            $table->string('event_type')->nullable()->change();
            if (!Schema::hasColumn('inquiries', 'estimated_attendance')) {
                $table->integer('estimated_attendance')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inquiries', function (Blueprint $table) {
            $table->dropColumn(['client_phone', 'event_location', 'budget_flexible']);
            $table->string('event_type')->nullable(false)->change();
        });
    }
};
