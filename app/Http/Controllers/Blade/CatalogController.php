<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Models\Blade\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CatalogController extends Controller
{

    public function index()
    {
        abort_if_forbidden('catalog.index');
        $catalogs = Catalog::all();
        return view('admin.catalog.index', compact('catalogs'));
    }

    public function create()
    {
        abort_if_forbidden('catalog.create');
        $catalogs = Catalog::where('is_active', 1)->get();
        return view('admin.catalog.create',compact('catalogs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        abort_if_forbidden('catalog.create');
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'parent_id' => 'required|numeric',
            'is_active' => 'required|boolean',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $catalog = Catalog::create($request->only('name','parent_id','is_active'));
        if($request->has('image')){
            $string = preg_replace("/[^a-zA-Zа-яА-Я0-9]/ui", "", $catalog->name);
            $imageName = $catalog->id.'-'.$string.'.'.$request->image->extension();
            $catalog->update(['image' => $imageName]);

            $request->image->move(public_path('uploads/catalogs'),$imageName);
        }
        message_set("Успешно! Новая каталог была добавлена.",'success',5);
        return redirect()->route('catalog.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blade\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function show(Catalog $catalog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blade\Catalog  $catalog
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Catalog $catalog)
    {
        abort_if_forbidden('catalog.edit');
        $catalogs = Catalog::where('is_active', 1)->get();
        return view('admin.catalog.edit',compact('catalog','catalogs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blade\Catalog  $catalog
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Catalog $catalog)
    {
        abort_if_forbidden('catalog.update');
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'parent_id' => 'required|numeric',
            'is_active' => 'required|boolean',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $catalog->update($request->only('name','parent_id','is_active'));
        if($request->has('image')){
            $string = preg_replace("/[^a-zA-Zа-яА-Я0-9]/ui", "", $catalog->name);
            $imageName = $catalog->id.'-'.$string.'.'.$request->image->extension();
            $request->image->move(public_path('uploads/catalogs'),$imageName);
            $catalog->update(['image' => $imageName]);
        }
        message_set("Успешно! Каталог была обновлена.",'success',5);
        return redirect()->route('catalog.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blade\Catalog  $catalog
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Catalog $catalog)
    {
        abort_if_forbidden('catalog.destroy');
        $catalog->delete();
        message_set("Успешно! Каталог была удалена.",'success',5);
        return redirect()->route('catalog.index');
    }
}
