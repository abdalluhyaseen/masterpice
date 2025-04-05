<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\sport_type;
use Illuminate\Http\Request;

class Landing extends Controller
{
    public function  index() {
     
$fields = Field::with('fieldImages')->take(6)->get();
$sportTypes = sport_type::take(6)->get();

    return view('landing_page.landing',compact('fields','sportTypes'));


    } 
}
