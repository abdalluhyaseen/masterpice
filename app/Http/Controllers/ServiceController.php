<?php

namespace App\Http\Controllers;
use App\Models\Field;
use App\Models\Field_images;
use App\Models\Field_type;
use App\Models\sport_type;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
public function index(Request $request)
{
    $query = Field::with(['fieldImages', 'sportType', 'fieldType']);

    if ($request->filled('sport_type')) {
        $query->whereHas('sportType', function($q) use ($request) {
            $q->where('id', $request->input('sport_type'));
        });
    }

    if ($request->filled('field_type')) {
        $query->where('field_type_id', $request->input('field_type'));
    }

    $fields = $query->get();

    $fieldTypes = Field_type::all();

    return view('landing_page.pages.services', [
        'fields' => $fields,
        'sportTypes' => sport_type::all(),
        'fieldTypes' => $fieldTypes
    ]);
}




public function show($id)
{
    $field = Field::with(['fieldImages', 'sportType', 'fieldType'])->findOrFail($id);
    return view('landing_page.pages.field_details', compact('field'));
}


}
