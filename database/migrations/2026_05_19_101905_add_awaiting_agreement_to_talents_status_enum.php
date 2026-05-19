<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * SQLite does not support ALTER COLUMN, so we recreate the table.
     * This migration is idempotent — it skips if the constraint is already updated.
     */
    public function up(): void
    {
        // Check if awaiting_agreement is already in the constraint
        $result = DB::selectOne("SELECT sql FROM sqlite_master WHERE type='table' AND name='talents'");
        $sql = $result ? $result->sql : '';
        if (str_contains($sql, "'awaiting_agreement'")) {
            return; // Already applied (e.g. previous partial run patched it)
        }

        DB::statement('PRAGMA foreign_keys = OFF');
        DB::statement('DROP TABLE IF EXISTS talents_new');
        DB::statement('CREATE TABLE talents_new AS SELECT * FROM talents');
        DB::statement('DROP TABLE talents');

        DB::statement("
            CREATE TABLE talents (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                slug TEXT NOT NULL UNIQUE,
                talent_type TEXT DEFAULT 'individual',
                member_count INTEGER,
                email TEXT,
                category_id INTEGER,
                bio TEXT,
                location TEXT,
                starting_price REAL,
                genre TEXT,
                years_active TEXT,
                technical_rider TEXT,
                website_url TEXT,
                instagram_handle TEXT,
                facebook_url TEXT,
                youtube_channel TEXT,
                tiktok_handle TEXT,
                primary_image_url TEXT,
                video_url TEXT,
                is_featured INTEGER DEFAULT 0 NOT NULL,
                status TEXT DEFAULT 'draft' NOT NULL CHECK(status IN ('draft','active','hidden','awaiting_agreement')),
                internal_notes TEXT,
                has_signed_agreement INTEGER DEFAULT 0 NOT NULL,
                agreement_signed_at TEXT,
                is_frozen INTEGER DEFAULT 0 NOT NULL,
                no_show_count INTEGER DEFAULT 0 NOT NULL,
                created_at TEXT,
                updated_at TEXT,
                deleted_at TEXT
            )
        ");

        DB::statement('INSERT INTO talents SELECT * FROM talents_new');
        DB::statement('DROP TABLE talents_new');
        DB::statement('PRAGMA foreign_keys = ON');
    }

    public function down(): void
    {
        $result = DB::selectOne("SELECT sql FROM sqlite_master WHERE type='table' AND name='talents'");
        $sql = $result ? $result->sql : '';
        if (! str_contains($sql, "'awaiting_agreement'")) {
            return;
        }

        DB::statement('PRAGMA foreign_keys = OFF');
        DB::statement('DROP TABLE IF EXISTS talents_new');
        DB::statement('CREATE TABLE talents_new AS SELECT * FROM talents');
        DB::statement('DROP TABLE talents');

        DB::statement("
            CREATE TABLE talents (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                slug TEXT NOT NULL UNIQUE,
                talent_type TEXT DEFAULT 'individual',
                member_count INTEGER,
                email TEXT,
                category_id INTEGER,
                bio TEXT,
                location TEXT,
                starting_price REAL,
                genre TEXT,
                years_active TEXT,
                technical_rider TEXT,
                website_url TEXT,
                instagram_handle TEXT,
                facebook_url TEXT,
                youtube_channel TEXT,
                tiktok_handle TEXT,
                primary_image_url TEXT,
                video_url TEXT,
                is_featured INTEGER DEFAULT 0 NOT NULL,
                status TEXT DEFAULT 'draft' NOT NULL CHECK(status IN ('draft','active','hidden')),
                internal_notes TEXT,
                has_signed_agreement INTEGER DEFAULT 0 NOT NULL,
                agreement_signed_at TEXT,
                is_frozen INTEGER DEFAULT 0 NOT NULL,
                no_show_count INTEGER DEFAULT 0 NOT NULL,
                created_at TEXT,
                updated_at TEXT,
                deleted_at TEXT
            )
        ");

        DB::statement('INSERT INTO talents SELECT * FROM talents_new');
        DB::statement('DROP TABLE talents_new');
        DB::statement('PRAGMA foreign_keys = ON');
    }
};
