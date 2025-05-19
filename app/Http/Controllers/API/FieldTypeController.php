<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Field_Type;

class FieldTypeController extends Controller
{
    public function index()
    {
        return Field_type::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'field_type' => 'required|string|max:255',
        ]);

        $fieldType = Field_type::create($request->all());

        return response()->json($fieldType, 201);
    }

    public function show($id)
    {
        return Field_type::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $fieldType = Field_type::findOrFail($id);
        $fieldType->update($request->all());

        return response()->json($fieldType);
    }

    public function destroy($id)
    {
        $fieldType = Field_type::findOrFail($id);
        $fieldType->delete(); // soft delete

        return response()->json(null, 204);
    }
}
