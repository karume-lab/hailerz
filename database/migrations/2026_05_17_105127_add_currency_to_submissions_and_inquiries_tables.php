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
        Schema::table('submissions', function (Blueprint $table) {
            $table->string('currency', 3)->default('USD')->after('max_rate');
        });

        Schema::table('inquiries', function (Blueprint $table) {
            $table->string('currency', 3)->default('USD')->after('budget_range');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropColumn('currency');
        });

        Schema::table('inquiries', function (Blueprint $table) {
            $table->dropColumn('currency');
        });
    }
};
