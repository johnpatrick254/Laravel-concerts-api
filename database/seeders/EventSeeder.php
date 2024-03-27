<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        for ($x = 0; $x < 200; $x++) {
            $user = $users->random();
            Event::factory()->create([
                'user_id' => $user->id
            ]);
        }
    }
}
