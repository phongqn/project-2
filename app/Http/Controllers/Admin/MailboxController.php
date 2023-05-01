<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Guest\Contact\ContactService;

class MailboxController extends Controller
{
    // 
    protected $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }
    
    public function index()
    {
        $list_mailbox = $this->contactService->getMailbox();
        return view('admin/mailbox/index', compact('list_mailbox'));
    }
}
