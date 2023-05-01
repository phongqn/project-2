<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\Category\CategoryRequest;
use App\Services\Admin\Category\CategoryService;

class CategoryController extends Controller
{
    //
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $list_categories =  $this->categoryService->get_all($request);
        return view('admin/category/index', compact('list_categories'));
    }

    public function create()
    {
        $list_categories = $this->categoryService->all();
        return view('admin/category/create', compact('list_categories'));
    }

    public function store(CategoryRequest $request)
    {
        $response = $this->categoryService->create($request);
        if (isset($response['error'])) {
            Toastr::error('Thông báo', 'Thêm danh mục thất bại');
            return redirect()->back();
        } else {
            Toastr::success('Thông báo', 'Thêm danh mục thành công');
            return redirect()->route('admin.category.index');
        }
    }

    public function edit($id)
    {
        $list_categories = $this->categoryService->all();
        $category = $this->categoryService->getById($id);
        return view('admin/category/edit', compact('list_categories', 'category'));
    }

    public function update(CategoryRequest $request, $id)
    {
        $response = $this->categoryService->update($id, $request);
        if (isset($response['error'])) {
            Toastr::error('Thông báo', 'Cập nhật danh mục thất bại');
            return redirect()->back();
        } else {
            Toastr::success('Thông báo', 'Cập nhật danh mục thành công');
            return redirect()->route('admin.category.index');
        }
    }

    public function destroy($id)
    {
        $response = $this->categoryService->destroy($id);
        if (isset($response['error'])) {
            Toastr::error('Thông báo', 'Bạn phải xoá danh mục cha trước');
            return redirect()->back();
        } else {
            Toastr::success('Thông báo', 'Xoá danh mục thành công');
            return redirect()->route('admin.category.index');
        }
    }
}
