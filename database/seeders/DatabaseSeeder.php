<?php

namespace Database\Seeders;

use App\Models\Inscription;
use App\Models\Race;
use App\Models\RaceCycle;
use App\Models\RaceResult;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // User::factory(10)->create();

        $this->call(RaceSeeder::class);
    }
}
