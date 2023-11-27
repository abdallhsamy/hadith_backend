<?php

namespace App\Http\Controllers\Mobile\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mobile\V1\Search\ContactRequest;
use App\Http\Requests\Mobile\V1\Search\SearchRequest;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Hadith;
use App\Models\Language;
use Illuminate\Http\Request;

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
            ->with('success', 'message sent successfully , we well connect you as soon as possible');
    }
}
