<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Image;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $brands = Brand::latest()->paginate(5);

        return view('admin.brand.index', compact('brands'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'brand_name' => 'required|unique:brands|max:50',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
        ], [
            'brand_name.required' => 'Please enter a valid Brand name',
            'brand_image.min' => 'Brand longer than 4 Characters.'
        ]);

        // // IMAGE UPLOAD CODE
        $brand_image = $request->file('brand_image');

        // // GENERATE UNIQUE ID FOR IMAGE FILE
        // $image_generated = hexdec(uniqid());
        // $image_ext = strtolower($brand_image->getClientOriginalExtension());  // CODE TO GET FILE EXTENSION
        // $image_name = $image_generated . '.' . $image_ext;  // FINAL UNIQUE IMAGE NAME WITH EXTENSION e.g. 32353425.png
        // $upload_location = 'images/brands/';      // UPLOAD DESTINATION FOR IMAGE FILES
        // $final_image_url = $upload_location . $image_name;

        // // FINALLY, MOVE THE IMAGE FILE TO DESTINATION FOLDER CODE : -
        // $brand_image->move($upload_location, $image_name);

        $image_name =  hexdec(uniqid()) . '.' . $brand_image->getClientOriginalExtension();  // FINAL UNIQUE IMAGE NAME WITH EXTENSION e.g. 32353425.png
        Image::make($brand_image)->resize(300,200)->save('images/brands/'.$image_name);
        $final_image_url = 'images/brands/'.$image_name;

        // INSERT BRAND DATA IN TO THE DB
        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $final_image_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Brand Created Successfully.',
            'alert-type' => 'success'
        ];

        // REDIRECT BACK TO PAGE
        return Redirect()->back()->with($notification);
    }

    public function edit($id)
    {
        $brand_data = Brand::find($id);
        return view('admin.brand.edit', compact('brand_data'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);

        $validatedData = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
        ], [
            'brand_name.required' => 'Please enter a valid Brand name',
            'brand_image.min' => 'Brand longer than 4 Characters.'
        ]);

        // IMAGE UPLOAD UPDATE CODE
        $old_image = $request->old_image;
        $brand_image = $request->file('brand_image');

        if ($brand_image) {

            // GENERATE UNIQUE ID FOR IMAGE FILE
            $image_generated = hexdec(uniqid());
            $image_ext = strtolower($brand_image->getClientOriginalExtension());  // CODE TO GET FILE EXTENSION
            $image_name = $image_generated . '.' . $image_ext;  // FINAL UNIQUE IMAGE NAME WITH EXTENSION e.g. 32353425.png
            $upload_location = 'images/brands/';      // UPLOAD DESTINATION FOR IMAGE FILES
            $final_image_url = $upload_location . $image_name;

            // FINALLY, MOVE THE IMAGE FILE TO DESTINATION FOLDER CODE : -
            $brand_image->move($upload_location, $image_name);

            // NEW IMAGE UPLOADED SO REMOVE OLD IMAGE 
            unlink($old_image);

            // INSERT BRAND DATA IN TO THE DB
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $final_image_url,
                'updated_at' => Carbon::now(),
            ]);

            $notification = [
                'message' => 'Brand Updated Successfully.',
                'alert-type' => 'info'
            ];

            // REDIRECT BACK TO PAGE
            return Redirect()->back()->with($notification);
        } else {

            // INSERT BRAND DATA IN TO THE DB
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'updated_at' => Carbon::now(),
            ]);

            $notification = [
                'message' => 'Brand Updated Successfully.',
                'alert-type' => 'info'
            ];

            // REDIRECT BACK TO PAGE
            return Redirect()->back()->with($notification);
        }
    }

    public function delete($id)
    {
        // REMOVE IMAGE FILE FIRST
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);

        $notification = [
            'message' => 'Brand Deleted.',
            'alert-type' => 'error'
        ];

        Brand::find($id)->delete();
        return Redirect()->route('all.brand')->with($notification);

    }

    public function logout()
    {
        Auth::logout();
        return Redirect()->route('login')->with('logout_succes','User logout successfull.');
    
    }

}
