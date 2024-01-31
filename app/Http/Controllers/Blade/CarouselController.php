<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Models\Blade\Carousel;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    public function index()
    {
        abort_if_forbidden('carousel.index');
        $carousels = Carousel::all();
        return view('admin.carousel.index',compact('carousels'));
    }
    public function create()
    {
        abort_if_forbidden('carousel.create');
        return view('admin.carousel.create');
    }
    public function store(Request $request)
    {
        abort_if_forbidden('carousel.create');
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'link' => 'required',
//            'image' => 'required',
        ]);
        $carousel = Carousel::create($request->only('title','description','link'));
        if ($request->hasFile('image')) {
            $imageName = $carousel->id.'.'.$request->image->extension();
            $request->image->move(public_path('uploads/carousel'), $imageName);
            $carousel->update(['image' => $imageName]);
        }
        message_set("Muvafaqqiyatli! Carousel created successfully.",'success',5);
        return redirect()->route('carousel.index');
    }
    public function edit(Carousel $carousel)
    {
        abort_if_forbidden('carousel.edit');
        return view('admin.carousel.edit',compact('carousel'));
    }
    public function update(Request $request, Carousel $carousel)
    {
        abort_if_forbidden('carousel.edit');
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'link' => 'required',
        ]);
        $carousel->update($request->only('title','description','link'));
        if ($request->hasFile('image')) {
            $imageName = $carousel->id.'.'.$request->image->extension();
            $request->image->move(public_path('uploads/carousel'), $imageName);
            $carousel->update(['image' => $imageName]);
        }
        message_set("Muvafaqqiyatli! Carousel updated successfully.",'success',5);
        return redirect()->route('carousel.index');
    }

    public function destroy(Carousel $carousel)
    {
        abort_if_forbidden('carousel.delete');
        $carousel->delete();
        message_set("Muvafaqqiyatli! Carousel deleted successfully.",'success',5);
        return redirect()->route('carousel.index');
    }
}
