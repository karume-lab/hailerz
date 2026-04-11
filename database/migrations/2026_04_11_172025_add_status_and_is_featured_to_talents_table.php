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
        Schema::table('talents', function (Blueprint $table) {
            if (!Schema::hasColumn('talents', 'status')) {
                $table->enum('status', ['draft', 'active', 'hidden'])->default('draft')->after('location');
            }
            if (!Schema::hasColumn('talents', 'internal_notes')) {
                $table->text('internal_notes')->nullable()->after('status');
            }
            if (!Schema::hasColumn('talents', 'is_featured')) {
                $table->boolean('is_featured')->default(false)->after('internal_notes');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('talents', function (Blueprint $table) {
            $table->dropColumn(['status', 'is_featured']);
        });
    }
};
