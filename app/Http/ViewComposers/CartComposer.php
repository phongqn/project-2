<?php


namespace App\Http\ViewComposers;

use App\Services\Guest\Cart\CartService;

use App\Services\Guest\Contact\ContactService;
use App\Services\Guest\Home\Homeservice;
use App\Services\Guest\Liked\LikedService;
use Illuminate\View\View;

class CartComposer
{
    public $favorite = 0;
    public $categories;
    public $notification;
    public $quantityLiked;
    public $quantityCart;
    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->quantityCart = CartService::getInstance()->totalQuantity();
        $this->quantityLiked = LikedService::getInstance()->quantityLiked();
        $this->favorite = 0;
        $this->categories = Homeservice::getInstance()->getCategory();
        $this->notification = ContactService::getInstance()->getNotification();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('quantityCart', $this->quantityCart);
        $view->with('categories', $this->categories);
        $view->with('notification', $this->notification);
        $view->with('quantityLiked', $this->quantityLiked);
    }
}
