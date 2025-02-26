<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        abort_if_forbidden('language.index');
        $languages = Language::all();
        return view('admin.language.index',compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        abort_if_forbidden('language.store');
        $this->validate($request,[
            'key' => ['required', 'unique:languages', 'string', 'max:255'],
            'uz'  =>  ['required'],
            'ru'    =>  ['required']
        ]);
        $language = Language::create([
            'key' => $request->get('key'),
            'uz' => $request->get('uz'),
            'ru' => $request->get('ru'),
            'oz' => $request->has('oz') ? $request->get('oz') : $request->get('uz'),
            'en' => $request->has('en') ? $request->get('en') : '',
        ]);
        message_set("Muvafaqqiyatli! Tarjima qo'shildi.",'success',3);
        return redirect()->route('languages.index');
    }

    public function updateModal(Request $request)
    {
        abort_if_forbidden('language.update');
        $this->validate($request,[
            'id'    =>  ['required'],
            'key'   =>  ['required', 'string', 'max:255'],
            'uz'    =>  ['required'],
            'ru'    =>  ['required']
        ]);
        $language = Language::findOrFail($request->get('id'));
        if ($language->key == $request->get('key')){
            $language->update([
                'uz' => $request->get('uz'),
                'ru' => $request->get('ru'),
                'oz' => $request->oz ? $request->get('oz') : '',
                'en' => $request->en ? $request->get('en') : '',
            ]);
        }else{
            message_set("Xatolik bor! Iltimos malumotlarni to'g'ri kiriting",'error',5);
            return redirect()->route('languages.index');
        }

        message_set("Muvafaqqiyatli! Tarjima ma'lumotlari o'zgartirildi.",'success',3);
        return redirect()->route('languages.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function show(Language $language)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function edit(Language $language)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Language $language)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Language $language)
    {
        abort_if_forbidden('language.destroy');
        $language->delete();
        message_set("Muvafaqqiyatli! Tarjima o'chirildi.",'success',3);
        return redirect()->route('languages.index');
    }
}
