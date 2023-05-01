<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Services\Admin\Auth\AuthService;
use App\Http\Requests\Auth\AuthRequest;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login()
    {
        if (!Auth::guard('admin')->check()) {
            return view('admin.auth.login');
        } else {
            return redirect()->route('admin.index');
        }
    }

    public function signIn(Request $request)
    {

        $remember_me = ($request->has('remember_me') && $request->remember_me == 1) ? true : false;
        if (Auth::guard('admin')->attempt(
            [
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ],
            $remember_me
        )) {

            return redirect()->route('admin.index');
        } else {

            auth('admin')->logout();
            return redirect()->back();
        }
    }

    public function logout()
    {
        auth('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function changePass()
    {
        return view('admin/auth/changePass');
    }
    
    public function updatePass(AuthRequest $request)
    {
        $response = $this->authService->update_pass($request);
        if (isset($response['error'])) {
            Toastr::error('Thông báo', 'Thay đổi mật khẩu thất bại');
            return redirect()->back();
        } else {
            Toastr::success('Thông báo', 'Thay đổi mật khẩu thành công');
            return redirect()->route('admin.index');
        }
    }
}
