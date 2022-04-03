<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\ContactForm;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('admin.contact.index',compact('contacts'));
    }

    public function add()
    {
        return view('admin.contact.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ], [
            'address.required' => 'Address Field is required.',
            'email.required' => 'Email field is required.',
            'phone.required' => 'Phone number is required.'
        ]);

        Contact::insert([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->route('admin.contact')->with('success','Contact profile created successfully.');

    }

    public function delete($id)
    {
        Contact::find($id)->delete();

        return Redirect()->back()->with('deleted','Contact Deleted.');
    }

    public function contact()
    {
        $contacts = DB::table('contacts')->first();
        return view('pages.contact',compact('contacts'));
    }

    public function contact_form(Request $request)
    {
        ContactForm::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('success','Your message sent successfully.');
    }

    public function admin_messages()
    {
        $messages = ContactForm::all();
        return view('admin.contact.messages',compact('messages'));
    }

    public function delete_message($id)
    {
        ContactForm::find($id)->delete();

        return Redirect()->back()->with('deleted','Message Deleted.');
    }
}
