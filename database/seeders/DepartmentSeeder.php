<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

// Models
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::beginTransaction();
        try{
            $departments = ['HR', 'Finance', 'Engineering', 'Marketing', 'Support'];

            foreach($departments as $dept){
                Department::firstOrCreate(
                    [
                        'name' => $dept
                    ],
                    ['created_at' => now(), 'updated_at' => now()]
                );
            }

            DB::commit();

            Log::info('DepartmentSeeder executed successfully.');
        } catch (\Throwable $e) {
            
            DB::rollBack();

            Log::error('DepartmentSeeder failed: ' . $e->getMessage());
        }
    }
}
