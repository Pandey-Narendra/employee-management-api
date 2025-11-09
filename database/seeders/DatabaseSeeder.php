<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

// Seeders
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\EmployeeSeeder;

// Model
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::beginTransaction();

        try {
            // Create a dummy user
            $dummyUser = User::firstOrCreate(
                ['email' => 'test@gmail.com'],
                [
                    'name' => 'Dummy User',
                    'password' => bcrypt('test@123'),
                ]
            );

            // Seed departments first
            $this->call([DepartmentSeeder::class]);

            // Seed employees using the dummy user
            $this->call(EmployeeSeeder::class);

            DB::commit();
            Log::info('DatabaseSeeder executed successfully at ' . now());
            $this->command->info("Database seeded successfully with dummy user: {$dummyUser->email}");

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('DatabaseSeeder failed: ' . $e->getMessage());
            $this->command->error('Seeder failed: ' . $e->getMessage());
        }
    }
}
