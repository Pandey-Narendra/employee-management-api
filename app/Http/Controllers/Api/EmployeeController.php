<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use App\Models\EmployeeContact;
use App\Models\EmployeeAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    protected int $cacheTtl = 300; // 5 minutes

    // public function __construct()
    // {
    //     $this->middleware(['auth:sanctum', 'token.not.expired']);
    // }

    /**
     * Helper to clear employee cache
     */
    private function clearEmployeeCache($userId)
    {
        foreach (range(1, 50) as $page) {
            foreach ([10, 15, 25, 50] as $perPage) {
                foreach ([null, 'search'] as $searchKey) {
                    $key = "employees:user:{$userId}:p={$page}:per={$perPage}:s={$searchKey}";
                    Cache::forget($key);
                }
            }
        }
    }

    /**
     * List employees (paginated + filterable)
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $perPage = (int) $request->get('per_page', 15);
        $page = (int) $request->get('page', 1);
        $search = $request->get('search');
        $departmentToken = $request->get('department_id');

        $cacheKey = "employees:user:{$user->id}:p={$page}:per={$perPage}:s=" . md5($search . '|' . $departmentToken);

        $result = Cache::remember($cacheKey, $this->cacheTtl, function () use ($user, $search, $departmentToken, $perPage) {
            $query = Employee::query()
                ->where('user_id', $user->id)
                ->select(['id','first_name','last_name','email','department_id','created_at'])
                ->with(['department:id,name'])
                ->orderBy('created_at', 'desc');

            if ($departmentToken) {
                try {
                    $departmentId = app(\App\Services\IdEncrypter::class)->decrypt($departmentToken);
                    $query->where('department_id', $departmentId);
                } catch (\Throwable $e) {
                    $query->whereRaw('0 = 1'); // invalid token => no results
                }
            }

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$search}%"])
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhereIn('id', function ($sub) use ($search) {
                          $sub->select('employee_id')->from('employee_contacts')->where('contact_number', 'like', "%{$search}%");
                      });
                });
            }

            return $query->paginate($perPage);
        });

        $encrypter = app(\App\Services\IdEncrypter::class);
        $result->getCollection()->transform(fn($emp) => [
            'id' => $encrypter->encrypt($emp->id),
            'first_name' => $emp->first_name,
            'last_name' => $emp->last_name,
            'email' => $emp->email,
            'department' => $emp->department ? [
                'id' => $encrypter->encrypt($emp->department->id),
                'name' => $emp->department->name,
            ] : null,
            'created_at' => $emp->created_at,
        ]);

        return response()->json(['status' => true, 'data' => $result]);
    }

    /**
     * Create employee
     */
    // public function store(StoreEmployeeRequest $request)
    // {
    //     // return response()->json(['status' => true, 'data' => '$data']);
    //     $user = $request->user();
    //     //  return response()->json(['status' => true, 'data' => '$data']);
    //     $encrypter = app(\App\Services\IdEncrypter::class);
    //     //  return response()->json(['status' => true, 'data' => '$data']);
    //     DB::beginTransaction();
    //     try {
    //         $departmentId = $encrypter->decrypt($request->department_id);
    //         //    return response()->json(['status' => true, 'user' => $user]);
    //         $employee = Employee::create([
    //             'first_name' => $request->first_name,
    //             'last_name' => $request->last_name,
    //             'email' => $request->email,
    //             'department_id' => $departmentId,
    //             'user_id' => $user->id,
    //         ]);

    //         // return response()->json(['status' => true, '$employee' => $employee, 'user' => $user, ' departmentId' =>  $departmentId]);
    //     //             if ($request->filled('contacts')) {
    //     //                     //  return response()->json(['status' => true, 'userss' => $user]);
    //     //                 $contacts = array_map(fn($c) => ['employee_id' => $employee->id, 'contact_number' => $c], $request->contacts);
    //     //                      return response()->json(['status' => true, 'contacts' => $contacts]);
    //     //   //    return response()->json(['status' => true, 'user' => $user]);
    //     //                 EmployeeContact::insert($contacts);
    //     //             }

    //               if ($request->filled('contacts') && is_array($request->contacts)) {
    //                     $contacts = array_map(fn($c) => [
    //                         'employee_id' => $employee->id,
    //                         'contact_number' => $c
    //                     ], $request->contacts);

    //                     try {
    //                         EmployeeContact::insert($contacts);
    //                     } catch (\Throwable $e) {
    //                         Log::error("Failed to insert contacts: {$e->getMessage()}");
    //                         throw new \Exception("Failed to insert contacts: " . $e->getMessage());
    //                     }
    //                 }


    //              return response()->json(['status' => true, 'user' => $user]);

    //         if ($request->filled('addresses')) {
    //             $addresses = array_map(fn($addr) => array_merge(['employee_id' => $employee->id], $addr), $request->addresses);
    //             EmployeeAddress::insert($addresses);
    //         }

    //         DB::commit();
    //         $this->clearEmployeeCache($user->id);

    //         return response()->json(['status' => true, 'data' => [
    //             'id' => $encrypter->encrypt($employee->id),
    //             'first_name' => $employee->first_name,
    //             'last_name' => $employee->last_name,
    //             'email' => $employee->email,
    //         ]], 201);

    //     } catch (\Throwable $e) {
    //         DB::rollBack();
    //         Log::error("Employee creation failed: {$e->getMessage()}");
    //         return response()->json(['status' => false, 'message' => 'Failed to create employee.'], 400);
    //     }
    // }

    public function store(StoreEmployeeRequest $request)
{
    $user = $request->user();
    $encrypter = app(\App\Services\IdEncrypter::class);

    DB::beginTransaction();

    try {
        // Decrypt department
        $departmentId = $encrypter->decrypt($request->department_id);

        // Create employee
        $employee = Employee::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'department_id' => $departmentId,
            'user_id' => $user->id,
        ]);

        // Insert contacts if any
        if ($request->filled('contacts') && is_array($request->contacts)) {
            $contacts = array_map(fn($c) => [
                'employee_id' => $employee->id,
                'contact_number' => $c
            ], $request->contacts);

            EmployeeContact::insert($contacts);
        }

        // Insert addresses if any
        if ($request->filled('addresses') && is_array($request->addresses)) {
            $addresses = array_map(fn($addr) => array_merge(['employee_id' => $employee->id], $addr), $request->addresses);
            EmployeeAddress::insert($addresses);
        }

        // Commit transaction
        DB::commit();

        // Clear cache
        $this->clearEmployeeCache($user->id);

        // Return success
        return response()->json(['status' => true, 'data' => [
            'id' => $encrypter->encrypt($employee->id),
            'first_name' => $employee->first_name,
            'last_name' => $employee->last_name,
            'email' => $employee->email,
        ]], 201);

    } catch (\Throwable $e) {
        DB::rollBack();
        Log::error("Employee creation failed: {$e->getMessage()}");

        return response()->json([
            'status' => false,
            'message' => 'Failed to create employee.',
            'error' => $e->getMessage() // Include exact error for debugging
        ], 400);
    }
}


    /**
     * Show employee
     */
    public function show(Request $request, $encryptedId)
    {
        $user = $request->user();
        $encrypter = app(\App\Services\IdEncrypter::class);

        try {
            $id = $encrypter->decrypt($encryptedId);
            $employee = Employee::where('id', $id)
                ->where('user_id', $user->id)
                ->with([
                    'department:id,name',
                    'contacts:id,employee_id,contact_number',
                    'addresses:id,employee_id,address_line,city,state,pincode'
                ])->firstOrFail();

            $response = [
                'id' => $encryptedId,
                'first_name' => $employee->first_name,
                'last_name' => $employee->last_name,
                'email' => $employee->email,
                'department' => $employee->department ? [
                    'id' => $encrypter->encrypt($employee->department->id),
                    'name' => $employee->department->name,
                ] : null,
                'contacts' => $employee->contacts->pluck('contact_number')->all(),
                'addresses' => $employee->addresses->map(fn($a) => [
                    'address_line' => $a->address_line,
                    'city' => $a->city,
                    'state' => $a->state,
                    'pincode' => $a->pincode,
                ])->all(),
                'created_at' => $employee->created_at,
            ];

            return response()->json(['status' => true, 'data' => $response]);

        } catch (\Throwable $e) {
            return response()->json(['status' => false, 'message' => 'Employee not found or access denied.'], 404);
        }
    }

    /**
     * Update employee
     */
    public function update(UpdateEmployeeRequest $request, $encryptedId)
    {
        $user = $request->user();
        $encrypter = app(\App\Services\IdEncrypter::class);

        DB::beginTransaction();
        try {
            $id = $encrypter->decrypt($encryptedId);
            $employee = Employee::where('id', $id)->where('user_id', $user->id)->firstOrFail();

            if ($request->filled('email') && Employee::where('email', $request->email)->where('id', '!=', $employee->id)->exists()) {
                throw new \Exception('Email already in use.');
            }

            if ($request->filled('department_id')) {
                $employee->department_id = $encrypter->decrypt($request->department_id);
            }

            $employee->fill($request->only(['first_name','last_name','email']));
            $employee->save();

            if ($request->filled('contacts')) {
                EmployeeContact::where('employee_id', $employee->id)->delete();
                EmployeeContact::insert(array_map(fn($c) => ['employee_id' => $employee->id, 'contact_number' => $c], $request->contacts));
            }

            if ($request->filled('addresses')) {
                EmployeeAddress::where('employee_id', $employee->id)->delete();
                EmployeeAddress::insert(array_map(fn($a) => array_merge(['employee_id' => $employee->id], $a), $request->addresses));
            }

            DB::commit();
            $this->clearEmployeeCache($user->id);

            return response()->json(['status' => true, 'data' => [
                'id' => $encryptedId,
                'first_name' => $employee->first_name,
                'last_name' => $employee->last_name,
                'email' => $employee->email,
            ]]);

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error("Employee update failed: {$e->getMessage()}");
            return response()->json(['status' => false, 'message' => 'Update failed.'], 400);
        }
    }

    /**
     * Delete employee
     */
    public function destroy(Request $request, $encryptedId)
    {
        $user = $request->user();
        $encrypter = app(\App\Services\IdEncrypter::class);

        try {
            $id = $encrypter->decrypt($encryptedId);
            $employee = Employee::where('id', $id)->where('user_id', $user->id)->firstOrFail();
            $employee->delete();

            $this->clearEmployeeCache($user->id);

            return response()->json(['status' => true, 'message' => 'Employee deleted.']);
        } catch (\Throwable $e) {
            Log::error("Employee deletion failed: {$e->getMessage()}");
            return response()->json(['status' => false, 'message' => 'Delete failed.'], 400);
        }
    }
}
