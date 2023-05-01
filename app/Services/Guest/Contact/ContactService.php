<?php

namespace App\Services\Guest\Contact;

use Throwable;
use App\Models\Mailbox;
use App\Models\Notification;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;


class ContactService extends BaseService
{
    public function __construct(Notification $notification)
    {
        $this->model = $notification;
    }

    public function getNotification()
    {
        $notification = $this->model->get();
        return $notification;
    }

    /**
     * @param Reuqest, $request
     *Người dùng gửi tin nhắn cho cửa hàng
     * @return  true false
     */

    public function createMailbox($request)
    {
        try {
            Mailbox::create([
                'name' => $request->name,
                'email' => $request->email,
                'messenger' => $request->message
            ]);
            return [
                'success' => true,
            ];
        } catch (Throwable $e) {
            return [
                'success' => false,
                'error' => $e
            ];
        }
    }

    /**
     *Lấy mail người dùng gửi
     * @return  array
     */

    public function getMailbox()
    {
        $list_mailbox = Mailbox::all();
        return $list_mailbox;
    }
}
