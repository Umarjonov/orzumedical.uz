<?php

namespace App\Http\Controllers;

use App\Models\Blade\Brand;
use App\Models\Blade\Carousel;
use App\Models\Blade\Catalog;
use App\Models\Blade\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function welcome()
    {
        $carousels = Carousel::where('status',1)->get();
        $catalogs = Catalog::where(['is_active'=>1,'parent_id'=>0])->with('child')->get();
        $brands = Brand::where(['is_active'=>1])->limit(10)->get();
        $products = Product::where(['is_active'=>1])->latest()->limit(10)->get();
        return view('welcome',compact('carousels','catalogs','brands','products'));
    }

    public function contact()
    {
        $catalogs = Catalog::where(['is_active'=>1,'parent_id'=>0])->with('child')->get();
        $brands = Brand::where(['is_active'=>1])->limit(10)->get();
        return view('frontend.contact',compact('catalogs','brands'));
    }

    public function shop(Request $request)
    {
        $catalogs = Catalog::where(['is_active'=>1,'parent_id'=>0])->with('child')->get();
        $brands = Brand::where(['is_active'=>1])->limit(10)->get();
        $products = Product::where('is_active',1)->latest()->paginate(9);
        return view('frontend.shop',compact('catalogs','brands','products'));
    }
}
