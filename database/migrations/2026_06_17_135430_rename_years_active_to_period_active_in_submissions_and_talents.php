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
            $table->renameColumn('years_active', 'period_active');
        });

        Schema::table('talents', function (Blueprint $table) {
            $table->renameColumn('years_active', 'period_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->renameColumn('period_active', 'years_active');
        });

        Schema::table('talents', function (Blueprint $table) {
            $table->renameColumn('period_active', 'years_active');
        });
    }
};
