<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inquiries', function (Blueprint $table) {
            $table->string('payment_reference')->nullable()->unique();
            $table->decimal('amount', 10, 2)->default(0.00);
            $table->string('payment_status')->default('pending'); // pending, paid, failed
        });
    }

    public function down(): void
    {
        Schema::table('inquiries', function (Blueprint $table) {
            $table->dropColumn(['payment_reference', 'amount', 'payment_status']);
        });
    }
};
