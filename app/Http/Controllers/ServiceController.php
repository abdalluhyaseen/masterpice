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

    // فلترة حسب نوع الرياضة
    if ($request->filled('sport_type')) {
        $query->whereHas('sportType', function($q) use ($request) {
            $q->where('id', $request->input('sport_type'));
        });
    }

    // فلترة حسب نوع الملعب
    if ($request->filled('field_type')) {
        $query->where('field_type_id', $request->input('field_type'));
    }

    // جلب البيانات بناءً على الاستعلامات
    $fields = $query->paginate(9); // استخدام الـpaginate لتقسيم النتائج


    $fieldTypes = Field_type::all();
    $sportTypes = sport_type::all(); // التأكد من جلب جميع أنواع الرياضات

    return view('landing_page.pages.services', [
        'fields' => $fields,
        'sportTypes' => $sportTypes,
        'fieldTypes' => $fieldTypes
    ]);
}






public function show($id)
{
    $field = Field::with(['fieldImages', 'sportType', 'fieldType'])->findOrFail($id);
    return view('landing_page.pages.field_details', compact('field'));
}


}
