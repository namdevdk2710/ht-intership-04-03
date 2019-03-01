<?php
namespace App\Http\Controllers\V1\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public  function getIndex()
    {
        return view('page.home');
    }
    public function  getProductType ()
    {
        return view('page.product_type') ;
    }
    public function  getPricing()
    {
        return view('page.pricing') ; 
    }
    public function  getShopingCart()
    {
        return view('page.shoping_cart') ;
    }
    public  function  getSinup()
    {
        return view('page.sinup') ;
    }

}
