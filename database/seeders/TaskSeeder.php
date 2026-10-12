<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $users = \App\Models\User::all();

        if ($users->isEmpty()) {
            $this->command->warn('No users found. Register a user first.');
            return;
        }

        foreach ($users as $user) {
            \App\Models\Task::factory()
                ->count(5)
                ->for($user)
                ->create();
        }

        $this->command->info('Sample tasks created successfully.');
    }
}
