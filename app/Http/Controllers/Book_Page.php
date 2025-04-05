<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Field;
use Carbon\Carbon;

use Illuminate\Http\Request;

class Book_Page extends Controller
    {
      
    public function index($field_id)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You need to be logged in to make a booking.');
        }

        $field = Field::findOrFail($field_id);

        $startHour = Carbon::parse($field->opens_at)->hour;
        $endHour = Carbon::parse($field->closes_at)->hour;

        $availableHours = [];
        for ($hour = $startHour; $hour < $endHour; $hour++) {
            $timeStr = sprintf("%02d:00", $hour);
            $availableHours[] = $timeStr;
        }

            return view('landing_page.pages.book', compact('field', 'availableHours'));


    }

    public function store(Request $request)
    {
        $request->validate([
            'field_id' => 'required|exists:fields,id',
            'date' => 'required|date',
            'start_at' => 'required|date_format:H:i',
            'duration' => 'required|integer|min:1',
        ]);

        $field = Field::findOrFail($request->input('field_id'));


        Booking::create([
            'field_id' => $request->input('field_id'),
            'user_id' => auth()->id(),
            'total_price' => $request->input('duration') * $field->field_price,
            'status' => 'pending',
            'date' => $request->input('date'),
            'start_at' => $request->input('start_at'),
            'duration' => $request->input('duration'),
        ]);

        return redirect()->route('services.index')->with('success', 'Booking successfully created!');
    }
    }



