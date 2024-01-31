<?php

namespace App\Http\Controllers;

use App\Models\Blade\Brand;
use App\Models\Blade\Carousel;
use App\Models\Blade\Catalog;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function welcome()
    {
        $carousels = Carousel::where('status',1)->get();
        $catalogs = Catalog::where(['is_active'=>1,'parent_id'=>0])->get();
        $brands = Brand::where(['is_active'=>1])->limit(10)->get();
//        return compact('carousels','catalogs');
        return view('welcome',compact('carousels','catalogs','brands'));
    }
}
