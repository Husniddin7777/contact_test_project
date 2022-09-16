<?php

namespace App\Http\Controllers;

use App\Models\ContactPhone;
use Illuminate\Http\Request;

class ContactPhoneController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'contact_id' => 'required|integer',
            'phone' => 'required|string|unique:contact_phones,phone'
        ]);

        $contact_phone = new ContactPhone();
        $contact_phone->contact_id = $request->contact_id;
        $contact_phone->phone = $request->phone;
        $contact_phone->save();

        return $contact_phone;

    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'phone' => 'required|string|unique:contact_phones,phone'
        ]);

        $contact_phone = ContactPhone::query()->find($id);
        if (empty($contact_phone)) {
        return response()->json(['message' => 'Номер не существуеть!'], 404);
        }

        $contact_phone->phone = $request->phone;
        $contact_phone->save();

        return $contact_phone;
    }

    public function delete($id)
    {
        $contact_phone = ContactPhone::query()->find($id);
        if (empty($contact_phone)) {
            return response()->json(['message' => 'Номер не существуеть!'], 404);
        }

        $contact_phone->delete();

        return response()->json(['message' => 'Номер удалён!']);
    }
}
