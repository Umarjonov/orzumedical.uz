<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Models\Blade\Brand;
use App\Models\Blade\Catalog;
use App\Models\Blade\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function indexApi()
    {
//        abort_if_api('product.index');
        $products = Product::with('catalog:id,name','user:id,name')->latest()->paginate(20);
        return self::good('product.index',$products);
    }
    public function index()
    {
        abort_if_forbidden('product.index');
        $catalogs = Catalog::where('is_active', 1)->get();
        $brands = Brand::where('is_active', 1)->get();
        return view('admin.product.index',compact('catalogs','brands'));
    }
    public function create()
    {
        abort_if_forbidden('product.create');
        $catalogs = Catalog::where('is_active', 1)->get();
        $brands = Brand::where('is_active', 1)->get();
        return view('admin.product.create',compact('catalogs','brands'));
    }

    public function store(Request $request)
    {
        abort_if_forbidden('product.create');
        if (!$request->has('name')||$request->name===null) {
            message_set("Ошибка! Поле 'Название продукта' обязательно для заполнения.",'error',5);
            return redirect()->back()->withInput();
        }
        $data = $request->only('name',"title","articul","weight","price","count","currency",'catalog_id','brand_id',"description","information","seo_title","seo_keywords","seo_description","telegram","facebook","instagram");
        $data['user_id'] = auth()->user()->id;
        $data['gallery'] = '["default-product-image.png"]';
        $product = Product::create($data);
        if($request->has('gallery')){
            $month = date('M-Y');
            $this->extracted($request, $product, $month);
        }
        message_set("Успешно! Новый товар был добавлен.",'success',5);
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blade\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        abort_if_forbidden('product.edit');
        $catalogs = Catalog::where('is_active', 1)->get();
        $brands = Brand::where('is_active', 1)->get();
        return view('admin.product.edit',compact('product','catalogs','brands'));
    }

    public function update(Request $request, Product $product)
    {
        abort_if_forbidden('product.edit');
        if (!$request->has('name')||$request->name===null) {
            message_set("Ошибка! Поле 'Название продукта' обязательно для заполнения.",'error',5);
            return redirect()->back()->withInput();
        }
        $data = $request->only('name',"title","articul","weight","price","count","currency",'catalog_id','brand_id',"description","information","seo_title","seo_keywords","seo_description","telegram","facebook","instagram");
        $data['user_id'] = auth()->user()->id;
        $product->update($data);
        if($request->has('gallery')){
            $month = date('M-Y');
            $gallery = json_decode($product->gallery);
            foreach ($gallery as $image){
                if (file_exists(public_path('uploads/products/'.$image))){
                    unlink(public_path('uploads/products/'.$image));
                }
            }
            $this->extracted($request, $product, $month);
        }
        message_set("Успешно! Товар был обновлен.",'success',5);
        return redirect()->route('product.index');
    }

    public function destroy(Product $product)
    {
        abort_if_forbidden('product.delete');
        $gallery = json_decode($product->gallery);
        foreach ($gallery as $image){
            if (file_exists(public_path('uploads/products/'.$image))){
                unlink(public_path('uploads/products/'.$image));
            }
        }
        $product->delete();
        message_set("Успешно! Товар был удален.",'success',5);
        return redirect()->route('product.index');
    }

    /**
     * @param Request $request
     * @param Product $product
     * @param string $month
     * @return void
     */
    public function extracted(Request $request, Product $product, string $month): void
    {
        $gallery = [];
        foreach ($request->gallery as $key => $image) {
            $imageName = $product->id . '-' . $key . '.' . $image->extension();
            $image->move(public_path('uploads/products/' . $month), $imageName);
            $gallery[] = $month . '/' . $imageName;
        }
        $product->update(['gallery' => json_encode($gallery)]);
    }
}
