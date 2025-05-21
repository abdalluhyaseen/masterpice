<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Field_images;
use App\Models\Field_type;
use App\Models\sport_type;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fields=Field::all();
    return view('Dashboard.fields.index',['fields'=>$fields]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    $sports = Sport_type::all();
    $fields = Field_type::all();
    return view('Dashboard.fields.create', ['sports' => $sports, 'fields' => $fields]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'field_name' => 'required|string|max:255',
            'field_description' => 'required|string',
            'field_location' => 'required|string|max:255',
            'field_price' => 'required|numeric',
            'sport_type_id' => 'required|exists:sport_types,id',
        'field_type_id' => 'required|exists:field_types,id',
            'opens_at' => 'nullable|date_format:H:i',
        'closes_at' => 'nullable|date_format:H:i',
        'is_24_hours' => 'nullable|boolean',
        ]);


        $validatedData['field_avilable'] = 0;


    if ($request->has('is_24_hours') && $request->is_24_hours == 1) {
        $validatedData['opens_at'] = null;
        $validatedData['closes_at'] = null;
    } else {
        $validatedData['is_24_hours'] = 0;
    }

        $field = Field::create($validatedData);

    if ($request->hasFile('field_images')) {
            foreach ($request->file('field_images') as $file) {
                $request->validate([
                    'field_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                $filename = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

                $path = $file->move(public_path('landing/img'), $filename);

                Field_images::create([
                    'field_images' => 'landing/img/' . $filename,
                    'field_id' => $field->id,
                ]);

                $path = $file->store('fields', 'public'); // سيتم حفظ الصورة داخل storage/app/public/fields

                Field_images::create([
                    'field_images' => $path,
                    'field_id' => $field->id,
                ]);


            }
        }
        return redirect()->route('fields.index')->with('success', 'Field created successfully');
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
      $field = Field::with(['sportType', 'fieldType', 'fieldImages'])->findOrFail($id);
    return view('Dashboard.fields.show', compact('field'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
    $field = Field::findOrFail($id);
    $sports = Sport_type::all();
    $fieldTypes = Field_type::all();
    return view('Dashboard.fields.edit', compact('field', 'sports', 'fieldTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $request->validate([
    'opens_at' => 'required|date_format:H:i',
    'closes_at' => 'required|date_format:H:i',
]);


          $field = Field::findOrFail($id);
$validatedData = $request->validate([
    'field_name' => 'required|string|max:255',
    'field_description' => 'required|string',
    'field_location' => 'required|string|max:255',
    'field_price' => 'required|numeric',
    'sport_type_id' => 'required|exists:sport_types,id',
    'field_type_id' => 'required|exists:field_types,id',
    'field_avilable' => 'required|boolean',
    'opens_at' => 'required|date_format:H:i',
    'closes_at' => 'required|date_format:H:i',
    'new_field_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
]);



    $field->update($validatedData);

    // Handle image deletions
    if ($request->has('delete_images')) {
        foreach ($request->delete_images as $imageId) {
            $image = Field_images::findOrFail($imageId);
            if (file_exists(public_path($image->field_images))) {
                unlink(public_path($image->field_images));
            }
            $image->delete();
        }
    }

    // Handle new image uploads
    if ($request->hasFile('field_images')) {
        foreach ($request->file('field_images') as $file) {
            $filename = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->move(public_path('landing/img'), $filename);

            Field_images::create([
                'field_images' => 'landing/img/' . $filename,
                'field_id' => $field->id,
            ]);
        }
    }

    return redirect()->route('fields.index')->with('success', 'Field updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
     $field = Field::findOrFail($id);

    // Delete associated images
    foreach ($field->fieldImages as $image) {
        // Delete the file from storage
        if (file_exists(public_path($image->field_images))) {
            unlink(public_path($image->field_images));
        }

        // Delete the database record
        $image->delete();
    }

    // Delete the field
    $field->delete();

    return redirect()->route('fields.index')->with('success', 'Field and associated images deleted successfully');
    }
}
