<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeAbout;
use App\Models\Multipic;
use Illuminate\Support\Carbon;

class AboutController extends Controller
{
    public function index()
    {
        $homeabouts = HomeAbout::latest()->get();
        return view('admin.home.index',compact('homeabouts'));
    }

    public function add()
    {
        return view('admin.home.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:50',
            'short_dis' => 'required',
            'long_dis' => 'required'
        ], [
            'title.required' => 'Please enter a valid title for about',
            'short_dis.required' => 'Please provide short description for about.',
            'long_dis.required' => 'Please provide long description for about.'
        ]);

        HomeAbout::insert([
            'title' => $request->title,
            'short_dis' => $request->short_dis,
            'long_dis' => $request->long_dis,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('home.about')->with('success','New About Created Successfully.');
    }

    public function edit($id)
    {
        $homeabout = HomeAbout::find($id);
        return view('admin.home.edit',compact('homeabout'));
    }

    public function update(Request $request,$id)
    {
        $update = HomeAbout::find($id)->update([
            'title' => $request->title,
            'short_dis' => $request->short_dis,
            'long_dis' => $request->long_dis,
            'updated_at' => Carbon::now()
        ]);

        // REDIRECT BACK 
        return Redirect()->route('home.about')->with('updated','About Updated Successfully.');
    }

    public function delete($id)
    {
        HomeAbout::find($id)->delete();

        return Redirect()->back()->with('deleted','About Deleted Successfully.');
    }

    public function portfolio()
    {
        $images = Multipic::all();
        return view('pages.portfolio',compact('images'));
    }
}
