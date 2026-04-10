<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Talent;
use App\Models\Booking;
use App\Models\Submission;
use App\Models\ContentResource as Content;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed the Admin from .env variables
        $adminEmail = env('ADMIN_EMAIL');
        $adminPassword = env('ADMIN_PASSWORD');

        if ($adminEmail && $adminPassword) {
            User::updateOrCreate(
                ['email' => $adminEmail],
                [
                    'name' => env('ADMIN_NAME', 'Admin'),
                    'password' => Hash::make($adminPassword),
                    'email_verified_at' => now(), // Sets verification to true
                ]
            );
        }

        // 2. Read and Seed the JSON Data
        $this->seedFromJson('talents.json', Talent::class, 'name');
        $this->seedFromJson('bookings.json', Booking::class, 'client_name');
        $this->seedFromJson('submissions.json', Submission::class, 'artist_name');
        $this->seedFromJson('contents.json', Content::class, 'title');
    }

    private function seedFromJson(string $filename, string $model, string $uniqueKey): void
    {
        $jsonPath = database_path("data/{$filename}");

        if (File::exists($jsonPath)) {
            $records = json_decode(File::get($jsonPath), true);

            foreach ($records as $data) {
                // If seeding users via JSON, verify them too
                if ($model === User::class) {
                    $data['email_verified_at'] = now();
                }

                $model::updateOrCreate(
                    [$uniqueKey => $data[$uniqueKey]],
                    $data
                );
            }
        }
    }
}