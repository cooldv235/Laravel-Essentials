<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // JOINING TABLES USING QUERY BUILDER EXAMPLE
        // $categories = DB::table('categories')
        //                 ->join('users','categories.user_id','users.id')
        //                 ->select('categories.*','users.name')
        //                 ->latest()->paginate(5);


        // $categories = Category::all();      // GET DATA UNSORTED IN SAME LIST FORMAT
        // $categories = Category::latest()->get();        // GET DATA SORTED BY DESCENDING ORDER FROM LATEST ONE CREATED
        $categories = Category::latest()->paginate(5);        // GET DATA SORTED BY DESCENDING ORDER FROM LATEST ONE CREATED
        $trashCategories = Category::onlyTrashed()->latest()->paginate(3);
        // $categories = DB::table('categories')->latest()->paginate(5);     // OR YOU CAN ALSO USE QUERY BUILDER
        return view('admin.category.index',compact('categories','trashCategories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
            'category_name' => 'required|unique:categories|max:25',
            ],
            [
                'category_name.required' => 'Please enter a valid category name.',      // IN CASE YOU WANT TO DISPLAY CUSTOME ERROR MESSAGE
                'category_name.max' => 'Maximum name length must be upto 25 characters.',
            ]
        );

        // Category::insert([
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id,
        //     'created_at' => Carbon::now(),
        // ]);

        // RECOMMENDED WAY
        // $category = new Category();
        // $category->category_name = $request->category_name;
        // $category->user_id = Auth::user()->id;
        // $category->save();

        // INSERTING DATA USING LARAVEL QUERY BUILDER
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        $data['created_at'] = Carbon::now();
        DB::table('categories')->insert($data);

        // REDIRECT AFTER SUCCESSFUL INSERT WITH CUSTOM MESSAGE
        return Redirect()->back()->with('success','Category Added');

    }

    public function edit($id)
    {
        // FETCH RECORD USING $id FROM DB
        // $category = Category::find($id);

        // OR YOU CAN ALSO USE QUERY BUILDER LIKE THIS 
        $category = DB::table('categories')->where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    public function update(Request $request,$id)
     {
    //     $update = Category::find($id)->update([
    //         'category_name' => $request->category_name,
    //         'user_id' => Auth::user()->id
    //     ]);

        // OR USE QUERY BUILDER FOR THE SAME AS ABOVE
        $data = [];
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        $data['updated_at'] = Carbon::now();
        DB::table('categories')->where('id',$id)->update($data);

        return Redirect()->route('all.category')->with('updated','Category updated successfully.');
    }

    public function soft_delete($id)
    {
        $delete = Category::find($id)->delete();

        // REDIRECT AFTER DELETING RECORD
        return Redirect()->back()->with('deleted','Category Deleted.');
    }

    public function restore($id)
    {
        $delete = Category::withTrashed()->find($id)->restore();

        // REDIRECT AFTER DELETING RECORD
        return Redirect()->back()->with('restore','Category Restored Successfully.');
    }

    public function permanent_delete($id)
    {
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('pdelete','Category Deleted Permanently.');
    }
}
