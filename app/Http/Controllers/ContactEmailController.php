<?php

namespace App\Http\Controllers;

use App\Models\ContactEmail;
use Illuminate\Http\Request;

class ContactEmailController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'contact_id' => 'required|integer',
            'email' => 'required|email|unique:contact_emails,email'
        ]);

        $contact_email = new ContactEmail();
        $contact_email->contact_id = $request->contact_id;
        $contact_email->email = $request->email;
        $contact_email->save();

        return $contact_email;

    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:contact_emails,email'
        ]);

        $contact_email = ContactEmail::query()->find($id);
        if (empty($contact_email)) {
            return response()->json(['message' => 'Email не существуеть!'], 404);
        }

        $contact_email->email = $request->email;
        $contact_email->save();

        return $contact_email;
    }

    public function delete($id)
    {
        $contact_email = ContactEmail::query()->find($id);
        if (empty($contact_email)) {
            return response()->json(['message' => 'Email не существуеть!'], 404);
        }

        $contact_email->delete();

        return response()->json(['message' => 'Email удалён!']);
    }
}
