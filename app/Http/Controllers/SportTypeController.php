<?php

namespace App\Http\Controllers;

use App\Models\sport_type;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class SportTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sports_type = sport_type::all();
        // dd($sports_type);
        return view('Dashboard.Sports.index')->with('sports_type', $sports_type);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $sports_type = sport_type::all();
        // return view('Dashboard.Sports.create')->with('sports_type', $sports_type);
            return view('Dashboard.Sports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sport_type' => 'required|string|max:255',
            'sport_image' => 'nullable|image',
            'sport_desc' => 'required|string|max:255',
        ]);

        if ($request->hasFile('sport_image')) {
            $sport_image = $request->file('sport_image');
            $filename = time() . '.' . $sport_image->getClientOriginalExtension();
            $path = 'landing/img/'; // Directory where you want to store the image
            $sport_image->move($path, $filename);

        // $path = $request->file('sport_image')->store('landing/img');
        }
        sport_type::create([
            'sport_type' => $request->sport_type,
            'sport_image' => $path . $filename,
            'sport_desc' => $request->sport_desc,
        ]);

        return redirect()->route('sport-types.index')->with('success', 'Sport type added successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(sport_type $sport_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sport_type= sport_type::findorFail($id);
        return view('Dashboard.Sports.edit')->with('sport_type', $sport_type);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $sport_type)
    {
        $sport_type = sport_type::findOrFail($sport_type);
    
    
        $request->validate([
            'sport_type' => 'required|string|max:255',
            'sport_image' => 'nullable|image',
            'sport_desc' => 'required|string|max:255',
        ]);
        if($request->has('sport_image')){
            $file= $request->file('sport_image');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $path='landing/img/';
            $file->move($path,$filename);
            if(File::exists($sport_type->sport_image)){
                File::delete($sport_type->sport_image);
            }
        }
                $sport_type->update([
            'sport_type'=> $request->sport_type,
            'sport_desc'=> $request->sport_desc,
                        'sport_image'=>$path.$filename,
    
        ]);
        // return to_route('movies.index');
        return redirect()->route('sport-types.index')->with('success', 'Movie updated successfully!');
    
        // Find the actual SportType model instance using the ID
        // $sport_type = sport_type::findOrFail($sport_type);
    
        // $request->validate([
        //     'sport_type' => 'required|string|max:255',
        //     'sport_image' => 'nullable|image',
        //     'sport_desc' => 'required|string|max:255',
        // ]);
    
        // // Handle image upload if present
        // if ($request->hasFile('sport_image')) {
        //     $path = public_path('landing/img/'); // Directory where you want to store the image
        //     // $path = $request->file('sport_image')->store('landing/img');
        //     $sport_type->sport_image = $path;
        // }
    
        // // Update the sport type and description
        // $sport_type->sport_type = $request->sport_type;
        // $sport_type->sport_desc = $request->sport_desc;
        // $sport_type->save();
    
        // return redirect()->route('sport-types.index')->with('success', 'Sport type updated successfully.');
    
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // $product->delete();
        sport_type::findorFail($id)->delete(); 
        // return redirect()->route('sport-types.index');
        return redirect()->back()->with('success', 'Sport Type Deleted successfully.');
    }
}
