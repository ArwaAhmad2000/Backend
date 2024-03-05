<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    function sendMessage(ContactRequest $request)
    {
        $data = $request->all();
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->user_id = auth()->id();
        $contact->save();
        return response()->json('YOUR MESSAGE SENT SUCSESFULY');
    }

    function showContactById($id)
    {
        $contact = Contact::findorfail($id);
        return response()->json($contact);
    }

    function showAllContacts()
    {
        $contacts = Contact::get();
        return response()->json($contacts);
    }
}
