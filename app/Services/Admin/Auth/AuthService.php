<?php

namespace App\Services\Admin\Auth;

use App\Models\Admin;
use Throwable;
use App\Models\User;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Class AuthServie.
 */
class AuthService extends BaseService

{
    /**
     * AuthService constructor.
     *
     * @param  User  $user
     * 
     */

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * @param Request ,$request
     * Cập nhật danh mục
     * @return  true false
     */

    public function update_pass($request)
    {
        try {
            Admin::where('id', Auth::guard('admin')->id())->update([
                'password' => Hash::make($request->password),
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
}
