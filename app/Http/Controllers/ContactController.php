<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactEmail;
use App\Models\ContactPhone;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $this->validate($request, [
            'name' => 'nullable|string'
        ]);

        $contacts = Contact::query();
        if (isset($request->name)) {
            $contacts->where('name', 'Like', '%' . $request->name . '%');
        }

        return $contacts->orderBy('id')->paginate(5, ['id', 'name']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:contacts,name',
            'phone' => 'required|string|unique:contact_phones,phone',
            'email' => 'required|email|unique:contact_emails,email'
        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->save();

        $contact_phone = new ContactPhone();
        $contact_phone->phone = $request->phone;
        $contact_phone->contact_id = $contact->id;
        $contact_phone->save();

        $contact_email = new ContactEmail();
        $contact_email->email = $request->email;
        $contact_email->contact_id = $contact->id;
        $contact_email->save();

        return $contact;
    }

    public function show($id)
    {
        $contact = Contact::with(['contact_phones', 'contact_emails'])->find($id);
        if (empty($contact)) {
            return response()->json(['message' => 'Контакт не существуеть!'], 404);
        }

        return $contact;
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:contacts,name'
        ]);

        $contact = Contact::query()->find($id);
        if (empty($contact)) {
            return response()->json(['message' => 'Контакт не существуеть!'], 404);
        }

        $contact->name = $request->name;
        $contact->save();

        return $contact;
    }

    public function delete($id)
    {
        $contact = Contact::query()->find($id);
        if (empty($contact)) {
            return response()->json(['message' => 'Контакт не существуеть!'], 404);
        }

        $contact->delete();

        return response()->json(['message' => 'Контакт удалён!']);

    }

}

