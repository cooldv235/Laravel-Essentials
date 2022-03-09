<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Carbon;
use Image;
use Auth;

class HomeController extends Controller
{
    public function slider()
    {
        $sliders = Slider::latest()->get();
        return view('admin.slider.index',compact('sliders'));
    }

    public function add()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|unique:sliders|max:50',
            'description' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png',
        ], [
            'title.required' => 'Please enter a valid Brand name',
            'description.required' => 'Please provide description for the slider',
            'image.min' => 'Brand longer than 4 Characters.'
        ]);

        // // IMAGE UPLOAD CODE
        $slider_image = $request->file('image');

        $image_name =  hexdec(uniqid()) . '.' . $slider_image->getClientOriginalExtension();  // FINAL UNIQUE IMAGE NAME WITH EXTENSION e.g. 32353425.png
        Image::make($slider_image)->resize(1920,1088)->save('images/sliders/'.$image_name);
        $final_image_url = 'images/sliders/'.$image_name;

        // INSERT BRAND DATA IN TO THE DB
        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $final_image_url,
            'created_at' => Carbon::now(),
        ]);

        // REDIRECT BACK TO PAGE
        return Redirect()->route('home.slider')->with('success', 'Slider Created Successfully.');

    }

    public function edit($id)
    {
        $slider_data = Slider::find($id);
        return view('admin.slider.edit', compact('slider_data'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);

        $validatedData = $request->validate([
            'title' => 'required|unique:sliders|max:50',
            'description' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png',
        ], [
            'title.required' => 'Please enter a valid Brand name',
            'description.required' => 'Please provide description for the slider',
            'image.min' => 'Brand longer than 4 Characters.'
        ]);

        // IMAGE UPLOAD UPDATE CODE
        $old_image = $request->old_image;
        $slider_image = $request->file('image');

        // IF USER WANTS TO UPDATE RECORD ALONG WITH IMAGE
        if ($slider_image) {

            // GENERATE UNIQUE ID FOR IMAGE FILE
            $image_generated = hexdec(uniqid());
            $image_ext = strtolower($slider_image->getClientOriginalExtension());  // CODE TO GET FILE EXTENSION
            $image_name = $image_generated . '.' . $image_ext;  // FINAL UNIQUE IMAGE NAME WITH EXTENSION e.g. 32353425.png
            $upload_location = 'images/sliders/';      // UPLOAD DESTINATION FOR IMAGE FILES
            $final_image_url = $upload_location . $image_name;

            // FINALLY, MOVE THE IMAGE FILE TO DESTINATION FOLDER CODE : -
            $slider_image->move($upload_location, $image_name);

            // NEW IMAGE UPLOADED SO REMOVE OLD IMAGE 
            unlink($old_image);

            // INSERT SLIDER DATA IN TO THE DB
            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $final_image_url,
                'updated_at' => Carbon::now(),
            ]);

            // REDIRECT BACK TO PAGE
            return Redirect()->route('home.slider')->with('success', 'Slider Updated Successfully.');
        } else {    // IF USER WANTS TO UPDATE RECORD WITHOUT IMAGE

            // INSERT SLIDER DATA IN TO THE DB
            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->title,
                'updated_at' => Carbon::now(),
            ]);

            // REDIRECT BACK TO PAGE
            return Redirect()->route('home.slider')->with('success', 'Slider Updated Successfully.');
        }
    }

    public function delete($id)
    {
        // REMOVE IMAGE FILE FIRST
        $image = Slider::find($id);
        $old_image = $image->image;
        unlink($old_image);

        Slider::find($id)->delete();
        return Redirect()->route('home.slider')->with('deleted', 'Slider Deleted Successfully.');

    }


}
