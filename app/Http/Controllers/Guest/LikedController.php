<?php

namespace App\Http\Controllers\Guest;

use App\Models\LikeProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Guest\Liked\LikedService;

class LikedController extends Controller
{
    //

    public function index()
    {
        if (Auth::check()) {
            $likeProduct = LikedService::getInstance()->getLikeProduct();
            return view('guest/liked/index', compact('likeProduct'));
        } else {
            return redirect()->route('login');
        }
    }

    public function addProduct(Request $request)
    {
        $response = LikedService::getInstance()->addLikeProduct($request);
        if (isset($response['error'])) {
            return redirect()->back()->with('error', $response['error']);
        } else {
            return redirect()->route('guest.liked.index');
        }
    }

    public function destroyProduct($id)
    {
        $response = LikedService::getInstance()->destroyLikeProduct($id);
        if (isset($response['error'])) {
            return redirect()->back()->with('error', 'Xoá thất bại');
        } else {
            return redirect()->back()->with('success', 'Xoá thành công');
        }
    }
}
