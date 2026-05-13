<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Musicians' => 'musicians',
            'DJs' => 'djs',
            'Speakers' => 'speakers',
            'Dancers' => 'dancers',
            'Artists' => 'artists',
            'Poets' => 'poets',
            'Content Creators' => 'content-creators',
            'Comedians' => 'comedians',
            'MCs' => 'mcs',
            'Variety Artists' => 'variety-artists',
        ];

        foreach ($categories as $name => $slug) {
            Category::updateOrCreate(
                ['slug' => $slug],
                ['name' => $name, 'is_active' => true]
            );
        }
    }
}
