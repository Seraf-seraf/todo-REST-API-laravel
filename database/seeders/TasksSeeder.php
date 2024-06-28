<?php

namespace Database\Seeders;

use App\Models\Tasks;
use Database\Factories\TasksFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tasks::factory()->count(10)->create();
    }
}
