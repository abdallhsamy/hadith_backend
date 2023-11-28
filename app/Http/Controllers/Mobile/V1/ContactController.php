<?php

namespace App\Http\Controllers\Mobile\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mobile\V1\Search\ContactRequest;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function contactView()
    {
        return view('mobile.contact');
    }

    public function postContact(ContactRequest $request)
    {
        ContactMessage::create($request->validated());

        return redirect()
            ->back()
            ->with('success', __('general.message_sent_successfully_we_well_connect_you_as_soon_as_possible'));

        // todo : send email to admin,
        // todo : send email to sender
        // todo : create admin message view
    }
}
