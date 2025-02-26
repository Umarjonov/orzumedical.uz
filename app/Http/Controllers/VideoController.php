<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Language;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::all();
        return view('admin.videos.index',compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.videos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_uz' => 'required',
            'title_ru' => 'required',
            'url' => 'required',
        ]);
        $data= $request->only(['url','status']);
        $video = Video::create($data);
        if ($request->hasFile('image')) {
            $imageName = $video->id.'-video.'.$request->image->extension();
            Video::whereId($video->id)->update([
                'image' => $imageName
            ]);
            $request->image->move(public_path('uploads/images/videos'),$imageName);
        }
        $language = [
            "key"=>"videos.".$video->id.".title",
            "uz"=>$request->title_uz,
            "ru"=>$request->title_ru,
            "en"=>$request->title_ru,
            "oz"=>$request->title_ru,
        ];
        Language::create($language);
        message_set("Video yaratildi",'success',5);
        return redirect()->route('videos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        $language = Language::where('key','videos.'.$video->id.'.title')->first();
        $video->title_uz = $language->uz;
        $video->title_ru = $language->ru;
        return view('admin.videos.edit',compact('video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title_uz' => 'required',
            'title_ru' => 'required',
            'url' => 'required',
        ]);
        $data= $request->only(['url','status']);
        $video->update($data);
        if ($request->hasFile('image')) {
            $imageName = $video->id.'-video.'.$request->image->extension();
            Video::whereId($video->id)->update([
                'image' => $imageName
            ]);
            $request->image->move(public_path('uploads/images/videos'),$imageName);
        }
        $language = [
            "uz"=>$request->title_uz,
            "ru"=>$request->title_ru,
            "en"=>$request->title_ru,
            "oz"=>$request->title_ru,
        ];
        Language::where('key','videos.'.$video->id.'.title')->update($language);
        message_set("Video o'zgartirildi",'success',5);
        return redirect()->route('videos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        Language::where('key','videos.'.$video->id.'.title')->delete();
        $video->delete();
        message_set("Video o'chirib yuborildi",'warning',5);
        return redirect()->route('videos.index');
    }
}
