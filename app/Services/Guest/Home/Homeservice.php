<?php

namespace App\Services\Guest\Home;

use App\Models\Product;
use App\Models\Category;
use App\Enums\TypeImgEnum;
use App\Models\LikeProduct;
use App\Models\Notification;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Homeservice extends BaseService
{
    /**
     *Lấy tất cả banner
     * @return  array
     */

    public function getAllBanner()
    {
        $banners = DB::table('banners')
            ->join('images', 'banners.id', '=', 'images.object_id')
            ->select('banners.*', 'images.path', 'images.type')
            ->where('images.type', TypeImgEnum::BANNER_IMG)
            ->orderBy('banners.index', 'ASC')
            ->get();

        return $banners;
    }


    /**
     *Lấy sản phẩm nổi bật
     * @return  array
     */

    public function getProductOutstanding()
    {
        $products = Product::where('status', '1')
            ->where('is_outstanding', 1)
            ->with('Img', 'ProductSize')
            ->whereHas('ProductSize')
            ->get();
        return $products;
    }

    /**
     *Lấy sản phẩm bán chạy
     * @return  array
     */

    public function getProductSelling()
    {
        $products = Product::where('status', '1')
            ->where('is_selling', 1)
            ->with('Img', 'ProductSize')
            ->whereHas('ProductSize')
            ->get();
        return $products;
    }

    /**
     *Lấy danh sách nhãn hàng
     * @return  array
     */

    public function getAllBrand()
    {
        $brands = DB::table('brands')
            ->join('images', 'brands.id', '=', 'images.object_id')
            ->select('brands.*', 'images.path', 'images.type')
            ->where('images.type', TypeImgEnum::BRAND_IMG)
            ->get();
        return $brands;
    }

    /**
     *Lấy thông tin cửa hàng
     * @return  array
     */

    public function getNotification()
    {
        $notification = Notification::all();
        return $notification;
    }

    /**
     *Lấy danh sách danh mục
     * @return  array
     */

    public function getCategory()
    {
        $categories = Category::with('children')->get()->toArray();
        return $categories;
    }

}
