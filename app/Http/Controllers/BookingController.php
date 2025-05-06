<?php

namespace App\Http\Controllers;

use App\Models\opening_hours;
use App\Models\Booking;
use App\Models\Field;
use Illuminate\Http\Request;
    use Carbon\Carbon;
    use Illuminate\Support\Facades\DB;



class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
 $query = Booking::query();

    if ($request->filled('status')) {
        $query->where('status', $request->input('status'));
    }

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereBetween('date', [$request->input('start_date'), $request->input('end_date')]);
    } elseif ($request->filled('start_date')) {
        $query->where('date', '>=', $request->input('start_date'));
    } elseif ($request->filled('end_date')) {
        $query->where('date', '<=', $request->input('end_date'));
    }

    $bookings = $query->get();

return view('Dashboard.bookings.index', compact('bookings'));


    }

public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:pending,confirmed,rejected',
    ]);

    $booking = Booking::findOrFail($id);
    $booking->status = $request->input('status');
    $booking->save();

    return redirect()->route('bookings.index')->with('success', 'Booking status updated successfully!');
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
 public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'field_id' => 'required|exists:fields,id',
        'date' => 'required|date',
        'start_at' => 'required|date_format:H:i',
        'duration' => 'required|integer|min:1',
    ]);

    // Check for conflicting bookings
    $startDateTime = Carbon::parse($request->date . ' ' . $request->start_at);
    $endDateTime = $startDateTime->copy()->addHours($request->duration);

    $conflictingBooking = Booking::where('field_id', $request->field_id)
        ->where(function ($query) use ($startDateTime, $endDateTime) {
            $query->whereBetween('start_at', [$startDateTime, $endDateTime])
                  ->orWhereBetween(DB::raw("DATE_ADD(start_at, INTERVAL duration HOUR)"), [$startDateTime, $endDateTime]);
        })
        ->exists();

    if ($conflictingBooking) {
        return back()->withErrors(['start_at' => 'The selected time slot is already booked. Please choose a different time.'])->withInput();
    }

    // Fetch field price
    $field = Field::findOrFail($request->field_id);
    $fieldPrice = $field->field_price;

    $duration = $request->duration;
    $totalPrice = $duration * $fieldPrice;

    // Create the booking
    $booking = Booking::create([
        'total_price' => $totalPrice,
        'status' => 'pending',
        'date' => $request->date,
        'start_at' => $startDateTime,
        'duration' => $request->duration,
        'user_id' => auth()->id(),
        'field_id' => $request->field_id,
    ]);

    return redirect()->route('services.index')->with('success', 'Your booking is pending review. Total Price: $' . number_format($totalPrice, 2));
}







    /**
     * Display the specified resource.
     */

public function show($id)
{
    // جلب الحجز بناءً على ID
    $booking = Booking::with('field')->findOrFail($id);

    // جلب تفاصيل الملعب المرتبط بالحجز
    $field = $booking->field;

    // التحقق إذا كان الملعب موجودًا
    if (!$field) {
        abort(404, 'Field not found.');
    }

    // حساب الأوقات المتاحة بناءً على وقت الفتح والإغلاق
    $opensAt = Carbon::parse($field->opens_at);
    $closesAt = Carbon::parse($field->closes_at);

    $availableHours = [];
    while ($opensAt->lessThan($closesAt)) {
        $availableHours[] = $opensAt->format('H:i'); // أو 'g:i A' حسب الصيغة المطلوبة
        $opensAt->addMinutes(30); // الفاصل الزمني بين الساعات
    }

    // تمرير البيانات إلى الـ View
    return view('Dashboard.bookings.show', compact('booking', 'availableHours'));
}

public function bookField($id)
{
    $field = Field::findOrFail($id);

    // حساب الأوقات المتاحة
    $opensAt = Carbon::parse($field->opens_at);
    $closesAt = Carbon::parse($field->closes_at);

    $availableHours = [];
    while ($opensAt->lt($closesAt)) {
        $availableHours[] = $opensAt->format('H:i');
        $opensAt->addMinutes(30);
    }

    // تمرير الأوقات إلى الـ View
    return view('landing_page.fields.book', compact('field', 'availableHours'));
}

public function createBookingForm($fieldId)
{
    $field = Field::findOrFail($fieldId);

    $opensAt = Carbon::parse($field->opens_at);
    $closesAt = Carbon::parse($field->closes_at);

    $availableHours = [];
    while ($opensAt->lt($closesAt)) {
        $availableHours[] = $opensAt->format('H:i'); // صيغة الزمن
        $opensAt->addMinutes(30); // الفاصل الزمني 30 دقيقة
    }

    return view('booking_form', compact('field', 'availableHours'));
}




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
