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
            $table->boolean('is_no_show')->default(false)->after('status');
        });

        Schema::table('talents', function (Blueprint $table) {
            $table->boolean('is_frozen')->default(false)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inquiries', function (Blueprint $table) {
            $table->dropColumn('is_no_show');
        });

        Schema::table('talents', function (Blueprint $table) {
            $table->dropColumn('is_frozen');
        });
    }
};
