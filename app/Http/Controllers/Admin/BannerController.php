<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\Banner\BannerRequest;
use App\Services\Admin\Banner\BannerService;

class BannerController extends Controller
{
    //
    protected $bannerService;

    public function __construct(BannerService $bannerService)
    {
        $this->bannerService = $bannerService;
    }

    public function index(Request $request)
    {
        $list_banners = $this->bannerService->get_all($request);
        return view('admin/banner/index', compact('list_banners'));
    }

    public function create()
    {
        return view('admin/banner/create');
    }

    public function store(BannerRequest $request)
    {
        $response = $this->bannerService->create($request);
        if (isset($response['error'])) {
            Toastr::error('Thông báo', 'Thêm banner thất bại');
            return redirect()->back();
        } else {
            Toastr::success('Thông báo', 'Thêm banner không thành công thành công');
            return redirect()->route('admin.banner.index');
        }
    }

    public function edit($id)
    {
        $banner = $this->bannerService->getById($id);
        return view('admin/banner/edit', compact('banner'));
    }

    public function update(BannerRequest $request, $id)
    {
        $response = $this->bannerService->update($id, $request);
        if (isset($response['error'])) {
            Toastr::error('Thông báo', 'Cập nhật banner thất bại');
            return redirect()->back();
        } else {
            Toastr::success('Thông báo', 'Cập nhật banner thành công');
            return redirect()->route('admin.banner.index');
        }
    }

    public function destroy($id)
    {
        $response = $this->bannerService->destroy($id);
        if (isset($response['error'])) {
            Toastr::error('Thông báo', 'Xoá banner thất bại');
            return redirect()->back();
        } else {
            Toastr::success('Thông báo', 'Xoá banner thành công');
            return redirect()->route('admin.banner.index');
        }
    }
}
