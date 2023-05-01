<?php

namespace App\Services\Admin\Category;

use Exception;
use Throwable;
use App\Models\Category;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

/**
 * Class CategoryService.
 */
class CategoryService extends BaseService
{
    /**
     * CategoryService constructor.
     *
     * @param  Category  $category
     * 
     */
    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    /**
     * @param Request ,$request
     * Lấy tất cả danh mục, tìm kiếm
     * @return  array
     */

    public function get_all($request)
    {
        $keyword = "";
        if ($request->input('q')) {
            $keyword = $request->input('q');
        }
        $categories = $this->model
            ->where('name', 'LIKE', "%{$keyword}%")
            ->latest()
            ->paginate(10);
        return $categories;
    }

    /**
     * @param Request ,$request
     * Tạo danh mục
     * @return true,false
     */
    public function create($request)
    {
        try {
            $this->model->create([
                'name' => $request->name,
                'parent_id' => $request->category_id
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
     * @param Request ,$request
     * Cạp danh mục
     * @return true, flase
     */
    public function update($id, $request)
    {
        // dd($request->id);
        try {
            $this->model->find($id)->update([
                'name' => $request->name,
                'parent_id' => $request->category_id
            ]);
            DB::commit();
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
     * @param id
     * Xoá danh mục
     * @return true false
     */


    public function destroy($id)
    {

        try {
            $category = $this->model->find($id);
            if ($category->parent_id == 0) {
                if ($category->children()->count() > 0) {
                    throw new Exception('Bạn phải xoá danh mục con trước!');
                }
            } else {
                if ($category->children()->count() > 0) {
                    throw new Exception('Bạn phải xoá danh mục con trước!');
                }
            }
            $category->delete();

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
