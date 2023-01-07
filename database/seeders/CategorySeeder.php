<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            [
                'uuid' => Str::uuid(),
                'name' => 'MMORPG'
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'FPS'
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'MOBA'
            ]
        ]);
    }
}
