<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\MultiPicController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChangePasswordController;
use App\Models\User;
use App\Models\Multipic;

Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $abouts = DB::table('home_abouts')->first();
    $images = Multipic::all();
    return view('home',compact('brands','abouts','images'));
});

// Route::get('about',function(){
//     return view('about');
// })->middleware('age');

Route::get('about',function(){
    return view('about');
});

// SYNTAX TO DEFINE A ROUTE TO A CONTROLLER
// USING NAMED ROUTES (TO MAKE SEO FRIENDLY LINKS): -
Route::get('/contact-webapp-ecommerce-buy',[ContactController::class,'index'])->name('contact');

/// EXAMPLE FOR USING MIDDLEWARE 


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

    // $users = User::all();
    // $users = DB::table('users')->get();
    return view('admin.index');
})->name('dashboard');

// CATEGORY ROUTES
Route::get('/category/all',[CategoryController::class,'index'])->name('all.category');
Route::post('/category/add',[CategoryController::class,'store'])->name('store.category');
Route::get('/category/edit/{id}',[CategoryController::class,'edit']);
Route::post('/category/update/{id}',[CategoryController::class,'update']);
Route::get('/softdelete/category/{id}',[CategoryController::class,'soft_delete']);
Route::get('/category/restore/{id}',[CategoryController::class,'restore']);
Route::get('/pdelete/category/{id}',[CategoryController::class,'permanent_delete']);

// BRAND ROUTES
Route::get('/brand/all',[BrandController::class,'index'])->name('all.brand');
Route::post('/brand/add',[BrandController::class,'store'])->name('store.brand');
Route::get('/brand/edit/{id}',[BrandController::class,'edit']);
Route::post('/brand/update/{id}',[BrandController::class,'update']);
Route::get('/brand/delete/{id}',[BrandController::class,'delete']);

// MULTIPLE IMAGES ROUTE
Route::get('multiple/images',[MultiPicController::class,'index'])->name('multiple.images');
Route::post('store/images',[MultiPicController::class,'store_multiple_images'])->name('store.images');

// EMAIL VERIFICATION
Route::get('/email/verify',function(){
    return view('auth.verify-email');
})->middleware(['auth'])->name('verification.notice');

// LOG OUT ROUTE
Route::get('/user/logout',[BrandController::class,'logout'])->name('user.logout');

// HOME PAGE ROUTES
Route::get('/home/slider',[HomeController::class,'slider'])->name('home.slider');
Route::get('/slider/edit/{id}',[HomeController::class,'edit'])->name('edit.slider');
Route::post('/slider/update/{id}',[HomeController::class,'update'])->name('edit.slider');
Route::get('/add/slider',[HomeController::class,'add'])->name('add.slider');
Route::post('/store/slider',[HomeController::class,'store'])->name('store.slider');
Route::get('/slider/delete/{id}',[HomeController::class,'delete']);


// HOME ABOUT ALL ROUTES
Route::get('/home/about',[AboutController::class,'index'])->name('home.about');
Route::get('/home/add',[AboutController::class,'add'])->name('add.about');
Route::post('/home/store',[AboutController::class,'store'])->name('store.about');
Route::get('/about/edit/{id}',[AboutController::class,'edit'])->name('edit.about');
Route::post('/update/homeabout/{id}',[AboutController::class,'update']);
Route::get('/about/delete/{id}',[AboutController::class,'delete'])->name('delete.about');

// PORTFOLIO ROUTES
Route::get('/portfolio',[AboutController::class,'portfolio'])->name('portfolio');


// CONTACT ALL ROUTES
Route::get('/admin/contact',[ContactController::class,'index'])->name('admin.contact');
Route::get('/admin/contact/delete/{id}',[ContactController::class,'delete'])->name('admin.contact');
Route::get('/admin/add/contact',[ContactController::class,'add'])->name('add.contact');
Route::get('/admin/contact/messages',[ContactController::class,'admin_messages'])->name('admin.messages');
Route::get('/admin/message/delete/{id}',[ContactController::class,'delete_message']);
Route::post('/admin/store/contact',[ContactController::class,'store'])->name('store.contact');

// FRONTEND CONTACT PAGE ROUTE
Route::get('/contact',[ContactController::class,'contact'])->name('contact');
Route::post('/contact/form',[ContactController::class,'contact_form'])->name('contact.form');

// CHANGE PASSWORD ROUTE
Route::get('/user/password',[ChangePasswordController::class,'index'])->name('change.password');
Route::post('/password/update',[ChangePasswordController::class,'update'])->name('password.update');

// USER PROFILE UPDATE
Route::get('/user/profile',[ChangePasswordController::class,'profile_update'])->name('profile.update');
Route::post('/user/profile/update',[ChangePasswordController::class,'update_profile'])->name('update.user.profile');

































