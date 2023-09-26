<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;

class HomeController extends Controller
{
    
public function index(){

    $sliders = Slider::where('status','1')->orderBy('id','desc')->get();

    
    return view('home',compact('sliders'));
}


public function about(){

    
    return view('about');
}



public function contact(){

    
    return view('contact');
}



public function properties(){

    
    return view('properties');
}



public function services(){

    
    return view('services');
}



public function propertySingle(){

    
    return view('property-single');
}

}
