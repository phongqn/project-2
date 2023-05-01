<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\Notification\NotificationRequest;
use App\Services\Admin\Notification\NotificationService;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function index()
    {
        $notification = $this->notificationService->get();
        return view('admin/notification/index', compact('notification'));
    }

    public function edit()
    {
        $notification = $this->notificationService->get();
        return view('admin/notification/edit', compact('notification'));
    }
    
    public function update(NotificationRequest $request)
    {
        $response = $this->notificationService->update($request);
        if (isset($response['error'])) {
            Toastr::error('Thông báo', 'Thay đổi thông tin thất bại');
            return redirect()->back();
        } else {
            Toastr::success('Thông báo', 'Thay đổi thông tin thành công');
            return redirect()->route('admin.notification.index');
        }
    }
}
