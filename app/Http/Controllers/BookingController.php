<?php

namespace App\Http\Controllers;

use App\Models\opening_hours;
use App\Models\Booking;
use App\Models\Field;
use Illuminate\Http\Request;

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

        $field = Field::findOrFail($request->field_id);
        $fieldPrice = $field->field_price;

        $duration = $request->duration;
        $totalPrice = $duration * $fieldPrice;

        $booking = Booking::create([
            'total_price' => $totalPrice,
            'status' => 'pending',
            'date' => $request->date,
            'start_at' => $request->start_at,
            'duration' => $request->duration,
            'user_id' => auth()->id(), 
            'field_id' => $request->field_id,
        ]);

        return redirect()->route('services.index')->with('success',  'Your booking is pending review. Total Price: $' . number_format($totalPrice, 2));
    }





    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       
    $booking = Booking::findOrFail($id);
    return view('Dashboard.bookings.show', compact('booking'));
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
