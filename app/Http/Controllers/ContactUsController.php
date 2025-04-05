<?php

namespace App\Http\Controllers;

use App\Models\Contact_us;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact_us::with('user')->get();
    
        return view('dashboard.contact_us', compact('contacts'));
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
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Create a new contact record
        Contact_us::create([
            'user_name' => $request->name,
            'user_email' => $request->email,
            'user_subject' => $request->subject,
            'user_message' => $request->message,
            'user_id' => auth()->id(), 
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact_us $contact_us)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact_us $contact_us)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact_us $contact_us)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact_us $contact_us)
    {
        //
    }
}
