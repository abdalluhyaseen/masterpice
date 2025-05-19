<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SportType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SportTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $sportTypes = SportType::all();
            return response()->json([
                'success' => true,
                'data' => $sportTypes,
                'message' => 'Sport types fetched successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch sport types: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sport_type' => 'required|string|max:255|unique:sport_types',
            'sport_image' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Validation failed'
            ], 422);
        }

        try {
            $sportType = SportType::create($validator->validated());
            return response()->json([
                'success' => true,
                'data' => $sportType,
                'message' => 'Sport type created successfully'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create sport type: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $sportType = SportType::find($id);

            if (!$sportType) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sport type not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $sportType,
                'message' => 'Sport type fetched successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch sport type: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $sportType = SportType::find($id);

        if (!$sportType) {
            return response()->json([
                'success' => false,
                'message' => 'Sport type not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'sport_type' => 'sometimes|string|max:255|unique:sport_types,sport_type,' . $id,
            'sport_image' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Validation failed'
            ], 422);
        }

        try {
            $sportType->update($validator->validated());
            return response()->json([
                'success' => true,
                'data' => $sportType,
                'message' => 'Sport type updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update sport type: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sportType = SportType::find($id);

        if (!$sportType) {
            return response()->json([
                'success' => false,
                'message' => 'Sport type not found'
            ], 404);
        }

        try {
            $sportType->delete();
            return response()->json([
                'success' => true,
                'message' => 'Sport type deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete sport type: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Restore the specified soft deleted resource.
     */
    public function restore($id)
    {
        $sportType = SportType::withTrashed()->find($id);

        if (!$sportType) {
            return response()->json([
                'success' => false,
                'message' => 'Sport type not found'
            ], 404);
        }

        try {
            $sportType->restore();
            return response()->json([
                'success' => true,
                'data' => $sportType,
                'message' => 'Sport type restored successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to restore sport type: ' . $e->getMessage()
            ], 500);
        }
    }
}
