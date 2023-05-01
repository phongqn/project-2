<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\Contact\ContactRequest;
use App\Services\Guest\Contact\ContactService;

class ContactController extends Controller
{
    //
    protected $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index()
    {
        $notification = $this->contactService->getNotification();
        return view('guest/contact/index', compact('notification'));
    }

    public function SendMessage(ContactRequest $request)
    {

        $response = $this->contactService->createMailbox($request);
        if (isset($response['error'])) {
            return redirect()->back()->with('error', 'Bạn đã gửi lời nhắn thất bại');
        } else {
            return redirect()->back()->with('success', 'Bạn đã gửi lời nhắn thành công');
        }
    }
}
