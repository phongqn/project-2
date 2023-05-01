<?php

namespace App\Http\Controllers\Guest;


use App\Http\Controllers\Controller;
use App\Services\Guest\Home\Homeservice;
use App\Services\Guest\Liked\LikedService;

class HomeController extends Controller
{
    protected $homeService;

    public function __construct(Homeservice $homeService)
    {
        $this->homeService = $homeService;
    }

    public function index()
    {
        $list_banners = $this->homeService->getAllBanner();
        $listOutstanding = $this->homeService->getProductOutstanding();
        $listSelling = $this->homeService->getProductSelling();
        $list_brands = $this->homeService->getAllBrand();
        $notification = $this->homeService->getNotification();
        $categories = $this->homeService->getCategory();
        // dd(compact('list_banners', 'listOutstanding', 'listSelling', 'list_brands', 'notification', 'categories'));
        return view('guest/home', compact('list_banners', 'listOutstanding', 'listSelling', 'list_brands', 'notification', 'categories'));
    }
}
