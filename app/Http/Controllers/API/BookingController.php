<?php

// app/Http/Controllers/API/BookingController.php
namespace App\Http\Controllers\API;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
public function index()
{
    $bookings = Booking::with(['field'])->get()->map(function ($booking) {
        return [
            'id' => $booking->id,
            'field' => [
                'field_name' => $booking->field->field_name,
                'field_description' => $booking->field->field_description,
            ],
            'date' => $booking->date->toDateString(),
            'start_at' => $booking->start_at,
            'duration' => (int)$booking->duration,
            'status' => $booking->status,
            'total_price' => (float)$booking->total_price, // تأكد من التحويل لرقم
        ];
    });

    return response()->json($bookings);
}

public function store(Request $request)
{
    // التحقق من البيانات المرسلة
    $validatedData = $request->validate([
        'field_id' => 'required|exists:fields,id',
        'date' => 'required|date|after_or_equal:today',
        'start_at' => 'required|date_format:H:i',
        'duration' => 'required|integer|min:1',
        'payment_method' => 'required|in:credit_card,paypal,cash',
        'card_number' => 'required_if:payment_method,credit_card',
        'card_expiry' => 'required_if:payment_method,credit_card',
        'card_cvc' => 'required_if:payment_method,credit_card',
        'paypal_email' => 'required_if:payment_method,paypal|email',
        'total_price' => 'required|numeric',
    ]);

    // حساب السعر الإجمالي (يمكن حسابه بناءً على المدة وسعر الملعب)
    // هنا نفترض أن السعر الإجمالي يتم حسابه في الواجهة الأمامية ويتم إرساله
    // إذا كنت تحتاج إلى حسابه في الخلفية، يمكنك استخدام:
    // $field = Field::find($request->field_id);
    // $total_price = $field->price_per_hour * $request->duration;

    // إنشاء الحجز
    $booking = new Booking();
    $booking->user_id = Auth::id(); // إذا كان المستخدم مسجل الدخول
    $booking->field_id = $validatedData['field_id'];
    $booking->date = $validatedData['date'];
    $booking->start_at = $validatedData['start_at'];
    $booking->duration = $validatedData['duration'];
    $booking->payment_method = $validatedData['payment_method'];
    $booking->total_price = $validatedData['total_price'];
    $booking->status = 'pending'; // أو أي حالة افتراضية تريدها

    // حفظ معلومات الدفع بناءً على طريقة الدفع
    if ($validatedData['payment_method'] == 'credit_card') {
        $booking->card_number = $validatedData['card_number'];
        $booking->card_expiry = $validatedData['card_expiry'];
        $booking->card_cvc = $validatedData['card_cvc'];
    } elseif ($validatedData['payment_method'] == 'paypal') {
        $booking->paypal_email = $validatedData['paypal_email'];
    }

    $booking->save();

    // إعادة التوجيه مع رسالة نجاح
    return redirect()->route('bookings.show', $booking->id)
        ->with('success', 'تم الحجز بنجاح!');
}




    public function show(Booking $booking)
    {
        return response()->json($booking->load(['user', 'field']));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'total_price' => 'sometimes|numeric',
            'status' => 'sometimes|string|in:pending,confirmed,cancelled,completed',
            'date' => \Carbon\Carbon::parse($booking->date)->toDateString(),
            'start_at' => 'sometimes|date_format:Y-m-d H:i:s',
            'duration' => 'sometimes|integer',
            'user_id' => 'sometimes|exists:users,id',
            'field_id' => 'sometimes|exists:fields,id',
        ]);

        $booking->update($validated);
        return response()->json($booking);
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return response()->json(null, 204);
    }


    // في BookingController
public function userBookings($userId)
{
    $bookings = Booking::where('user_id', $userId)
                ->with(['field.sportType', 'field.fieldType'])
                ->get();
    return response()->json($bookings);
}

public function fieldBookings($fieldId)
{
    $bookings = Booking::where('field_id', $fieldId)
                ->with(['user', 'field'])
                ->get();
    return response()->json($bookings);
}
}
