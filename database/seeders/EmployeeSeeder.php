<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\User;
use App\Models\Employee;
use App\Models\EmployeeContact;
use App\Models\EmployeeAddress;

class EmployeeSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();

        try {
            // Get dummy user
            $dummyUser = User::where('email', 'test@gmail.com')->first();
            if (!$dummyUser) {
                throw new \Exception('Dummy user not found. Make sure DatabaseSeeder creates it first.');
            }

            // Create 20 employees linked to the dummy user
            Employee::factory(20)->create(['user_id' => $dummyUser->id])->each(function ($emp) {
                EmployeeContact::factory(rand(1, 3))->create(['employee_id' => $emp->id]);
                EmployeeAddress::factory(rand(1, 2))->create(['employee_id' => $emp->id]);
            });

            DB::commit();
            Log::info('EmployeeSeeder executed successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('EmployeeSeeder failed: ' . $e->getMessage());
        }
    }
}
