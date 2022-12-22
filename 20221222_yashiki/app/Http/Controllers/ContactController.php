<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm(ContactRequest $request)
    {
        $form = $request->all();
        return view('confirm', ['form' => $form]);
    }

    public function send(Request $request)
    {
        $action = $request->input('action');
        $form = $request->except('action');
        unset($form['_token']);

        if ($action !== 'submit') {
            return redirect()
                ->route('contact.index')
                ->withInput($form);
        } else {
            Contact::create([
                'fullname' => $request->fullname,
                'gender' => $request->gender,
                'email' => $request->email,
                'postcode' => $request->postcode,
                'address' => $request->address,
                'building_name' => $request->building_name,
                'opinion' => $request->opinion,
            ]);
            return view('thanks');
        }
    }

    public function addmin()
    {
        $forms = Contact::Paginate(10);
        return view('addmin', ['forms' => $forms]);
    }

    public function search(Request $request)
    {
        $action = $request->input('action');
        if ($action !== 'search') {
            return redirect()
                ->route('contact.addmin');
        }

        $fullname = $request['fullname'];
        $gender = $request['gender'];
        $date_first = $request['date_first'];
        $date_last = $request['date_last'];
        $email = $request['email'];
        $forms = Contact::doSearch($fullname, $gender, $date_first, $date_last, $email);
        return view('addmin', ['forms' => $forms]);
    }

    public function delete(Request $request)
    {
        Contact::find($request->id)->delete();
        return back();
    }
}
