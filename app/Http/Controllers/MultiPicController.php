<?php

namespace App\Http\Controllers;

use App\Models\Multipic;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Image;

class MultiPicController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $images = Multipic::all();
        return view('admin.multipics.index',compact('images'));
    }

    public function store_multiple_images(Request $request)
    {
        $validatedData = $request->validate([
            'image[]' => 'required|mimes:jpg,jpeg,png',
        ], [
            'image[].required' => 'Please select atleast one image and only with jpg,jpeg,png extensions.',
        ]);

        // // IMAGE UPLOAD CODE
        $images = $request->file('image');

        foreach($images as $image){

            $image_name =  hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();  // FINAL UNIQUE IMAGE NAME WITH EXTENSION e.g. 32353425.png
            Image::make($image)->resize(300,200)->save('images/multiple_images/'.$image_name);
            $final_image_url = 'images/multiple_images/'.$image_name;

            // INSERT BRAND DATA IN TO THE DB
            Multipic::insert([
                'image' => $final_image_url,
                'created_at' => Carbon::now(),
            ]);
        }   // END FOR EACH LOOP

        // REDIRECT BACK TO PAGE
        return Redirect()->back()->with('success', 'Brand Added Successfully.');
    }
}
