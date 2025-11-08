<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class DepartmentController extends Controller
{
    // Cache TTL in seconds
    protected int $cacheTtl = 300; // 5 minutes

    // public function __construct()
    // {
    //     // Apply Sanctum auth + custom token expiry middleware
    //     $this->middleware(['auth:sanctum', 'token.not.expired']);
    // }

    /**
     * List departments (paginated) — cached
     */
    public function index(Request $request)
    {
        try {
            $perPage = (int) $request->get('per_page', 15);
            $page = (int) $request->get('page', 1);

            $cacheKey = "departments:page={$page}:per={$perPage}";

            $data = Cache::remember($cacheKey, $this->cacheTtl, function () use ($perPage) {
                return Department::select('id', 'name')
                    ->orderBy('name')
                    ->paginate($perPage);
            });

            $idEncrypter = app(\App\Services\IdEncrypter::class);
            $data->getCollection()->transform(fn($dept) => [
                'id' => $idEncrypter->encrypt($dept->id),
                'name' => $dept->name,
            ]);

            return response()->json(['status' => true, 'data' => $data]);
        } catch (\Throwable $e) {
            Log::error("Department listing failed: {$e->getMessage()}");
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch departments.',
            ], 500);
        }
    }

    /**
     * Create department
     */
    public function store(StoreDepartmentRequest $request)
    {
        // return response()->json(['status' => true, 'data' => '$data']);
        try {
            $dept = Department::create(['name' => $request->name]);

            // Invalidate cache for all paginated lists
            $this->clearDepartmentCache();

            $idEncrypter = app(\App\Services\IdEncrypter::class);
            return response()->json([
                'status' => true,
                'data' => [
                    'id' => $idEncrypter->encrypt($dept->id),
                    'name' => $dept->name,
                ],
            ], 201);
        } catch (\Throwable $e) {
            Log::error("Department creation failed: {$e->getMessage()}");
            return response()->json([
                'status' => false,
                'message' => 'Failed to create department.',
            ], 500);
        }
    }

    /**
     * Show department
     */
    public function show($encryptedId)
    {
        try {
            $id = app(\App\Services\IdEncrypter::class)->decrypt($encryptedId);
            $dept = Department::select('id', 'name')->findOrFail($id);

            return response()->json([
                'status' => true,
                'data' => [
                    'id' => $encryptedId,
                    'name' => $dept->name,
                ],
            ]);
        } catch (\Throwable $e) {
            Log::error("Department show failed: {$e->getMessage()}");
            return response()->json([
                'status' => false,
                'message' => 'Department not found.',
            ], 404);
        }
    }

    /**
     * Update department
     */
    public function update(StoreDepartmentRequest $request, $encryptedId)
    {
        try {
            $id = app(\App\Services\IdEncrypter::class)->decrypt($encryptedId);
            $dept = Department::findOrFail($id);

            $dept->update(['name' => $request->name]);

            $this->clearDepartmentCache();

            return response()->json([
                'status' => true,
                'data' => [
                    'id' => $encryptedId,
                    'name' => $dept->name,
                ],
            ]);
        } catch (\Throwable $e) {
            Log::error("Department update failed: {$e->getMessage()}");
            return response()->json([
                'status' => false,
                'message' => 'Failed to update department.',
            ], 400);
        }
    }

    /**
     * Delete department (soft delete)
     */
    public function destroy($encryptedId)
    {
        try {
            $id = app(\App\Services\IdEncrypter::class)->decrypt($encryptedId);
            $dept = Department::findOrFail($id);
            $dept->delete();

            $this->clearDepartmentCache();

            return response()->json(['status' => true, 'message' => 'Department deleted.']);
        } catch (\Throwable $e) {
            Log::error("Department deletion failed: {$e->getMessage()}");
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete department.',
            ], 400);
        }
    }

    /**
     * Helper: Clear all paginated department caches
     */
   private function clearDepartmentCache()
    {
        // Simple approach: clear all cache keys starting with 'departments:'
        // Works with file, database, or array cache
        foreach (range(1, 50) as $page) { // assuming max 50 pages; adjust if needed
            foreach ([10, 15, 25, 50] as $perPage) {
                $key = "departments:page={$page}:per={$perPage}";
                Cache::forget($key);
            }
        }
    }

}
