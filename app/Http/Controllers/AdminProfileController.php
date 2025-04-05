<?php

namespace App\Http\Controllers;

use App\Models\sport_type;
use Illuminate\Support\Facades\File;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class AdminProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin_profile = auth()->user();
        // $reservation = Booking::all();
        return view('Dashboard.Profile.admin')->with('admin_profile', $admin_profile);
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
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = 'admin_Profile/'; // Directory where you want to store the image
            $image->move($path, $filename);

        // $path = $request->file('sport_image')->store('landing/img');
        }
        sport_type::create([
            // 'sport_type' => $request->sport_type,
            'image' => $path.$filename,
            // 'sport_desc' => $request->sport_desc,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $admin_profile=auth()->user()->id;
        // $admin = User::findorFail($id);
        
        return view('Dashboard.Profile.admin')->with('admin_profile', $admin_profile);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $admin_profile = User::findorFail($id);
        
        if($request->has('image')){
            $file= $request->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $path='admin_Profile/';
            $file->move($path,$filename);
            if(File::exists($admin_profile->image)){
                File::delete($admin_profile->image);
            }
        }
            $admin_profile->update([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> $request->password,
            'phone'=> $request->phone,
            'image'=>$path.$filename,

        ]);
        // dd($admin_profile);
        // return to_route('movies.index');
        return view('Dashboard/Profile/admin', ['admin_profile'=> $admin_profile])->with('success', 'Admin info updated successfully!');





        // $request->validate([
        //     'name' => 'required|max:255|string',
        //     'email' => 'required|max:255|email',
        //     // 'password' => 'required|max:255|password',
        //     'phone' => 'nullable|max:15|string',
        //     'image' => 'nullable|mimes:png,jpg,jpeg,webp',
        // ]);
        
        // if($request->hasFile('image')){

        //     $path = $request->file('image')->store('admin_Profile/');
        //     $admin_profile->image = $path;

            // $file = $request->file('image');
            // $extension = $file->getClientOriginalExtension();

            // $filename = time().'.'.$extension;

            // $path = 'landing/img/';
            // $file->move($path, $filename);

            // if(File::exists($admin_profile->image)){
            //     File::delete($admin_profile->image);
            // }
        // }

        // $admin_profile->update([
        //     "name" => $request->name,
        //     "email" => $request->email,
        //     "password" => $request->password,
        //     "phone" => $request->phone,
        //     "image" => $request->image,
        // ]);

        // Handle image upload
        // if ($request->hasFile('image')) {
        //     $imageName = time().'.'.$request->image->extension();  
        //     $request->image->move(public_path('images'), $imageName);
        //     $admin_prof->image = 'images/' . $imageName;
        // }

        // $admin_profile->save();

        // return redirect()->back()->with('success', 'Profile updated successfully.');
        // // return redirect()->route('a_profile', $admin_prof->id)->with('success', 'Profile updated successfully.'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
