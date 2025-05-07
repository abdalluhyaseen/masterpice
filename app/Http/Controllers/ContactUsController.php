<?php

namespace App\Http\Controllers;

use App\Models\Contact_us;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
    // التحقق من صحة البيانات
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    // حفظ الرسالة
    Contact_us::create([
        'user_name' => $request->name,
        'user_email' => $request->email,
        'user_subject' => $request->subject,
        'user_message' => $request->message,
        'user_id' => auth()->id(), // هذا سيبقى null إذا لم يكن المستخدم مسجلًا
    ]);

    // إعادة التوجيه مع رسالة نجاح
    return redirect()->back()->with('success', 'Your message has been sent successfully.');
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


    public function reply(Request $request)
{
    $request->validate([
        'contact_id' => 'required|exists:contact_uses,id',
        'email' => 'required|email',
        'reply_message' => 'required|string',
    ]);

    // إرسال الإيميل
    Mail::raw($request->reply_message, function ($message) use ($request) {
        $message->to($request->email)
                ->subject('Reply to your message');
    });

    return redirect()->back()->with('success', 'Reply sent successfully!');
}

}
