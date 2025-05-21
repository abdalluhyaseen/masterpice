<?php

// app/Http/Controllers/API/FieldController.php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Field;
use Illuminate\Http\Request;

class FieldController extends Controller
{

    public function index()
    {
        $fields = Field::with(['sportType', 'fieldType'])->get();

        $fields->each(function ($field) {
            $field->field_name = $field->field_name ?? '';
            $field->field_description = $field->field_description ?? '';
            $field->field_location = $field->field_location ?? '';
            $field->opening_time = $field->opening_time ?? '';

            // تأكد أن field_price مرسلة كرقم (float) وليس كسلسلة نصية
            $field->field_price = is_numeric($field->field_price)
                ? (float)$field->field_price
                : 0.0;

            // تحويل الصورة إلى رابط كامل
            $field->image_url = $field->image
                ? url(asset('storage/landing/img/' . $field->image))
                : null;

            // تحويل sport_image إلى رابط كامل
            if ($field->sportType) {
                $field->sportType->sport_image = $field->sportType->sport_image
                    ? url(asset('storage/' . $field->sportType->sport_image))
                    : null;
            }
        });

        return response()->json($fields);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'field_name' => 'required|string|max:255',
            'field_description' => 'required|string',
            'field_location' => 'required|string',
            'field_avilable' => 'required|boolean',
            'opening_time' => 'nullable|string',
            'field_price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // تعديل حسب الحاجة
            'sport_type_id' => 'required|exists:sport_types,id',
            'field_type_id' => 'required|exists:field_types,id',
        ]);

        $field = Field::create($validated);
        return response()->json($field, 201);
    }

 public function show(Field $field)
{
    $field->field_price = (float)$field->field_price;
    return response()->json($field->load(['sportType', 'fieldType']));
}

public function availableFields()
{
    $fields = Field::where('field_avilable', true)
                ->with(['sportType', 'fieldType'])
                ->get()
                ->each(function ($field) {
                    $field->field_price = (float)$field->field_price;

                    // تحويل الصورة إلى رابط كامل
                    $field->image_url = $field->image
                        ? url(asset('storage/landing/img/' . $field->image))
                        : null;

                    // تحويل sport_image إلى رابط كامل
                    if ($field->sportType) {
                        $field->sportType->sport_image = $field->sportType->sport_image
                            ? url(asset('storage/' . $field->sportType->sport_image))
                            : null;
                    }
                });

    return response()->json($fields);
}




    public function update(Request $request, Field $field)
    {
        $validated = $request->validate([
            'field_name' => 'sometimes|string|max:255',
            'field_description' => 'sometimes|string',
            'field_location' => 'sometimes|string',
            'field_avilable' => 'sometimes|boolean',
            'opening_time' => 'nullable|string',
            'field_price' => 'sometimes|numeric',
            'sport_type_id' => 'sometimes|exists:sport_types,id',
            'field_type_id' => 'sometimes|exists:field_types,id',
        ]);

        $field->update($validated);
        return response()->json($field);
    }

    public function destroy(Field $field)
    {
        $field->delete();
        return response()->json(null, 204);
    }

    // في FieldController

    public function fieldsBySportType($sportTypeId)
    {
        try {
            $fields = Field::where('sport_type_id', $sportTypeId)
                            ->with(['sportType', 'fieldType'])
                            ->get()
                            ->each(function ($field) {
                                $field->field_price = (float)$field->field_price;

                                // تحويل الصورة إلى رابط كامل
                                $field->image_url = $field->image
                                    ? url(asset('storage/landing/img/' . $field->image))
                                    : null;

                                // تحويل sport_image إلى رابط كامل
                                if ($field->sportType) {
                                    $field->sportType->sport_image = $field->sportType->sport_image
                                        ? url(asset('storage/' . $field->sportType->sport_image))
                                        : null;
                                }
                            });

            return response()->json($fields);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch fields by sport type',
            ], 500);
        }
    }


public function availableSlots(Field $field, Request $request)
{
    $request->validate([
        'date' => 'required|date_format:Y-m-d',
    ]);

    try {
        // 1. الحصول على التاريخ من الطلب
        $date = $request->query('date');

        // 2. محاكاة بيانات الفترات الزمنية (استبدل هذا بمنطقك الفعلي)
        $slots = [
            [
                'id' => 1,
                'time' => '09:00 - 10:30',
                'status' => 'available',
                'price' => $field->field_price
            ],
            [
                'id' => 2,
                'time' => '11:00 - 12:30',
                'status' => 'available',
                'price' => $field->field_price
            ],
            [
                'id' => 3,
                'time' => '14:00 - 15:30',
                'status' => 'booked',
                'price' => $field->field_price
            ]
        ];

        // 3. إرجاع البيانات كـ JSON
        return response()->json([
            'success' => true,
            'data' => $slots,
            'field' => [
                'id' => $field->id,
                'name' => $field->field_name,
                'price' => (float)$field->field_price
            ]
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to fetch available slots',
            'error' => $e->getMessage()
        ], 500);
    }
}

}
