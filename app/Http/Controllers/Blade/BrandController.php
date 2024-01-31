<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Models\Blade\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        abort_if_forbidden('catalog.index');
        $brands = Brand::all();
        return view('admin.brand.index', compact('brands'));
    }

    public function create()
    {
        abort_if_forbidden('catalog.create');
        return view('admin.brand.create');
    }

    public function store(Request $request)
    {
        abort_if_forbidden('catalog.create');
        if (!$request->has('name')) {
            message_set("Ошибка! Необходимо указать название бренда.",'danger',5);
            return redirect()->back();
        }
        $brand = Brand::create($request->only('name','is_active'));
        $this->extracted($request, $brand);
        message_set("Успешно! Новый бренд был добавлен.",'success',5);
        return redirect()->route('brand.index');
    }

    public function edit(Brand $brand)
    {
        abort_if_forbidden('catalog.edit');
        return view('admin.brand.edit',compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        abort_if_forbidden('catalog.edit');
        if (!$request->has('name')) {
            message_set("Ошибка! Необходимо указать название бренда.",'danger',5);
            return redirect()->back();
        }
        $brand->update($request->only('name','is_active'));
        $this->extracted($request, $brand);
        message_set("Успешно! Бренд был обновлен.",'success',5);
        return redirect()->route('brand.index');
    }

    public function destroy(Brand $brand)
    {
        abort_if_forbidden('catalog.destroy');
        $brand->delete();
        message_set("Успешно! Бренд был удален.",'success',5);
        return redirect()->route('brand.index');
    }

    /**
     * @param Request $request
     * @param Brand $brand
     * @return void
     */
    public function extracted(Request $request, Brand $brand): void
    {
        if ($request->has('image')) {
            $string = preg_replace("/[^a-zA-Zа-яА-Я0-9]/ui", "", $brand->name);
            $imageName = $brand->id . '-' . $string . '.' . $request->image->extension();
            $brand->update(['image' => $imageName]);

            $request->image->move(public_path('uploads/brands'), $imageName);
        }
    }
}
