<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Game::insert([
            [
                'uuid'        => Str::uuid(),
                'name'        => 'Knight Online',
                'category_id' => 1
            ],
            [
                'uuid'        => Str::uuid(),
                'name'        => 'Valorant',
                'category_id' => 2
            ],
            [
                'uuid'        => Str::uuid(),
                'name'        => 'DOTA',
                'category_id' => 3
            ]
        ]);
    }
}
