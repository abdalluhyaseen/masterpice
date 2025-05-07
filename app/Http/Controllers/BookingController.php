<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\opening_hours;
use App\Mail\BookingConfirmed;
use App\Mail\BookingStatusUpdated;
use Illuminate\Support\Facades\Mail;
    use Carbon\Carbon;
    use Illuminate\Support\Facades\DB;
    use App\Notifications\BookingAccepted;


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
    // العثور على الحجز
    $booking = Booking::findOrFail($id);

    // تحديث الحالة
    $booking->status = $request->input('status');
    $booking->save();

    // إرسال البريد الإلكتروني
    Mail::to($booking->user->email)->send(new BookingStatusUpdated($booking));

    // إعادة التوجيه أو الرد
    return redirect()->route('bookings.show', $booking->id)->with('status', 'Booking status updated successfully!');
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

    Mail::to($request->user())->send(new BookingConfirmed($booking));
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

public function createBookingForm($fieldId, Request $request)
{
    $field = Field::findOrFail($fieldId);

    // حساب أوقات العمل للملعب
    $opensAt = Carbon::parse($field->opens_at);
    $closesAt = Carbon::parse($field->closes_at);

    // جميع الأوقات المحتملة
    $allHours = [];
    while ($opensAt->lt($closesAt)) {
        $allHours[] = $opensAt->format('H:i'); // صيغة الوقت
        $opensAt->addMinutes(30); // الفاصل الزمني 30 دقيقة
    }

    // جلب الحجوزات الموجودة لهذا اليوم
    $date = $request->input('date', Carbon::today()->toDateString()); // اليوم الحالي إذا لم يتم تحديد تاريخ
    $bookings = Booking::where('field_id', $fieldId)
        ->where('date', $date)
        ->get();

    // الأوقات المحجوزة
   $reservedHours = [];
foreach ($bookings as $booking) {
    $startTime = Carbon::parse($booking->start_at);
    $endTime = $startTime->copy()->addHours($booking->duration);

    while ($startTime->lt($endTime)) {
        $reservedHours[] = $startTime->format('H:i');
        $startTime->addMinutes(30);
    }
}


    // تصفية الأوقات المتاحة
    $availableHours = array_diff($allHours, $reservedHours);

    // تمرير البيانات إلى العرض
    return view('booking_form', compact('field', 'availableHours'));
}




public function getAvailableHours(Request $request, $fieldId)
{
    $field = Field::findOrFail($fieldId);

    // حساب أوقات العمل
    $opensAt = Carbon::parse($field->opens_at);
    $closesAt = Carbon::parse($field->closes_at);

    // جميع الأوقات
    $allHours = [];
    while ($opensAt->lt($closesAt)) {
        $allHours[] = $opensAt->format('H:i');
        $opensAt->addHour(); // الفاصل الزمني
    }

    // الأوقات المحجوزة
    $date = $request->input('date', Carbon::today()->toDateString());
    $bookings = Booking::where('field_id', $fieldId)
        ->where('date', $date)
        ->get();

    $reservedHours = [];
    foreach ($bookings as $booking) {
        $startTime = Carbon::parse($booking->start_at);
        $endTime = $startTime->copy()->addHours($booking->duration);

        // حساب الأوقات المحجوزة بما يشمل البداية والنهاية بدقة
        while ($startTime->lte($endTime)) {
            $reservedHours[] = $startTime->format('H:i');
            $startTime->addMinutes(30);
        }
    }

    // الأوقات المتاحة
    $availableHours = array_diff($allHours, $reservedHours);

    return response()->json(['availableHours' => array_values($availableHours)]);
}




public function acceptBooking($id)
{
    $booking = Booking::findOrFail($id);

    // تغيير حالة الحجز إلى مقبول
    $booking->status = 'accepted';
    $booking->save();

    // إرسال الإشعار إلى المستخدم
    $user = $booking->user; // تأكد أن هناك علاقة بين الحجز والمستخدم
    $user->notify(new BookingAccepted($booking));

    return redirect()->back()->with('success', 'Booking accepted and email sent to the user.');
}

public function testEmail()
{
    Mail::raw('This is a test email!', function ($message) {
        $message->to('recipient_email@gmail.com')
                ->subject('Test Email');
    });

    return 'Email sent!';
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
