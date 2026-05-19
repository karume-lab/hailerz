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
                category_id INTEGER,
                name TEXT NOT NULL,
                slug TEXT NOT NULL UNIQUE,
                bio TEXT,
                technical_rider TEXT,
                starting_price REAL,
                location TEXT,
                status TEXT DEFAULT 'draft' NOT NULL CHECK(status IN ('draft','active','hidden','awaiting_agreement')),
                internal_notes TEXT,
                is_featured INTEGER DEFAULT 0 NOT NULL,
                created_at TEXT,
                updated_at TEXT,
                deleted_at TEXT,
                genre TEXT,
                video_url TEXT,
                primary_image_url TEXT,
                rate_card_url TEXT,
                website_url TEXT,
                instagram_handle TEXT,
                facebook_url TEXT,
                youtube_channel TEXT,
                tiktok_handle TEXT,
                years_active TEXT,
                has_signed_agreement INTEGER DEFAULT 0 NOT NULL,
                agreement_signed_at TEXT,
                email TEXT,
                is_frozen INTEGER DEFAULT 0 NOT NULL,
                country TEXT
            )
        ");

        DB::statement('
            INSERT INTO talents (
                id, category_id, name, slug, bio, technical_rider, starting_price, location, status,
                internal_notes, is_featured, created_at, updated_at, deleted_at, genre, video_url,
                primary_image_url, rate_card_url, website_url, instagram_handle, facebook_url,
                youtube_channel, tiktok_handle, years_active, has_signed_agreement, agreement_signed_at,
                email, is_frozen, country
            )
            SELECT 
                id, category_id, name, slug, bio, technical_rider, starting_price, location, status,
                internal_notes, is_featured, created_at, updated_at, deleted_at, genre, video_url,
                primary_image_url, rate_card_url, website_url, instagram_handle, facebook_url,
                youtube_channel, tiktok_handle, years_active, has_signed_agreement, agreement_signed_at,
                email, is_frozen, country
            FROM talents_new
        ');
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
                category_id INTEGER,
                name TEXT NOT NULL,
                slug TEXT NOT NULL UNIQUE,
                bio TEXT,
                technical_rider TEXT,
                starting_price REAL,
                location TEXT,
                status TEXT DEFAULT 'draft' NOT NULL CHECK(status IN ('draft','active','hidden')),
                internal_notes TEXT,
                is_featured INTEGER DEFAULT 0 NOT NULL,
                created_at TEXT,
                updated_at TEXT,
                deleted_at TEXT,
                genre TEXT,
                video_url TEXT,
                primary_image_url TEXT,
                rate_card_url TEXT,
                website_url TEXT,
                instagram_handle TEXT,
                facebook_url TEXT,
                youtube_channel TEXT,
                tiktok_handle TEXT,
                years_active TEXT,
                has_signed_agreement INTEGER DEFAULT 0 NOT NULL,
                agreement_signed_at TEXT,
                email TEXT,
                is_frozen INTEGER DEFAULT 0 NOT NULL,
                country TEXT
            )
        ");

        DB::statement('
            INSERT INTO talents (
                id, category_id, name, slug, bio, technical_rider, starting_price, location, status,
                internal_notes, is_featured, created_at, updated_at, deleted_at, genre, video_url,
                primary_image_url, rate_card_url, website_url, instagram_handle, facebook_url,
                youtube_channel, tiktok_handle, years_active, has_signed_agreement, agreement_signed_at,
                email, is_frozen, country
            )
            SELECT 
                id, category_id, name, slug, bio, technical_rider, starting_price, location, status,
                internal_notes, is_featured, created_at, updated_at, deleted_at, genre, video_url,
                primary_image_url, rate_card_url, website_url, instagram_handle, facebook_url,
                youtube_channel, tiktok_handle, years_active, has_signed_agreement, agreement_signed_at,
                email, is_frozen, country
            FROM talents_new
        ');
        DB::statement('DROP TABLE talents_new');
        DB::statement('PRAGMA foreign_keys = ON');
    }
};
