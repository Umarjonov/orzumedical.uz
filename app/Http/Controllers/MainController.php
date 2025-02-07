<?php

namespace App\Http\Controllers;

use App\Models\Blade\Brand;
use App\Models\Blade\Carousel;
use App\Models\Blade\Catalog;
use App\Models\Blade\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MainController extends Controller
{
    public function welcome()
    {
        return view("comingsoon.index");
    }

    public function contact()
    {
        $catalogs = Catalog::where(['is_active'=>1,'parent_id'=>0])->with('child')->get();
        $brands = Brand::where(['is_active'=>1])->limit(10)->get();
        return view('frontend.contact',compact('catalogs','brands'));
    }

    public function shop()
    {
        $brand_cat = Cache::remember('brand_cat', 99099, function(){
            $catalogs = Catalog::where(['is_active'=>1,'parent_id'=>0])->with('child')->get();
            $brands = Brand::where(['is_active'=>1])->limit(10)->get();
            return compact('catalogs','brands');
        });
        $filterData = Cache::get('filterData',[]);
        $brand_cat['filterData'] = $filterData;
        return $this->extracted($brand_cat);
    }

    public function shopPost(Request $request)
    {
        $filterData = $request->only('catalog','brand','search');
        Cache::put('filterData',$filterData,9990);
        $brand_cat = Cache::remember('brand_cat', 99099, function(){
            $catalogs = Catalog::where(['is_active'=>1,'parent_id'=>0])->with('child')->get();
            $brands = Brand::where(['is_active'=>1])->limit(10)->get();
            return compact('catalogs','brands');
        });
        $brand_cat['filterData'] = $filterData;
        return $this->extracted($brand_cat);
    }

    public function shopCatalog($id)
    {
        $f = ['catalog'=>[$id]];
        Cache::put('filterData',$f,9990);
        return redirect()->route('shop');
    }

    /**
     * @param mixed $filterData
     * @param mixed $brand_cat
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function extracted(mixed $brand_cat): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        $brand_cat['products'] = Product::where('is_active', 1)
            ->when(isset($brand_cat['filterData']['catalog']), fn($q) => $q->whereIn('catalog_id', $brand_cat['filterData']['catalog']))
            ->when(isset($brand_cat['filterData']['brand']), fn($q) => $q->whereIn('brand_id', $brand_cat['filterData']['brand']))
            ->when(isset($brand_cat['filterData']['search']), fn($q) => $q->where('name', 'like', '%' . $brand_cat['filterData']['search'] . "%"))
            ->latest()->paginate(9);
        return view('frontend.shop', $brand_cat);
    }
}
