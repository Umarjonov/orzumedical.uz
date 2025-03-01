<?php

namespace App\Http\Controllers;

use App\Models\CallBack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CallBackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if_forbidden('callback.index');
        $callBacks = CallBack::all();
        return view('admin.callbacks.index', compact('callBacks'));
    }

    public function updateStatus(Request $request)
    {
        abort_if_forbidden('callback.update');
        $validate = Validator::make($request->all(), [
            'id' => 'required|exists:call_backs,id',
            'status' => 'required|in:new,pending,cancel,done'
        ]);
        if ($validate->fails()) {
            message_set($validate->errors()->first(), 'danger', 5);
            return redirect()->back()->withErrors($validate)->withInput();
        }
        $callBack = CallBack::find($request->id);
        $callBack->status = $request->status;
        $callBack->save();
        message_set('Status updated successfully', 'success', 5);
        return redirect()->back();
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CallBack  $callBack
     * @return \Illuminate\Http\Response
     */
    public function show(CallBack $callBack)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CallBack  $callBack
     * @return \Illuminate\Http\Response
     */
    public function edit(CallBack $callBack)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CallBack  $callBack
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CallBack $callBack)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CallBack  $callBack
     * @return \Illuminate\Http\Response
     */
    public function destroy(CallBack $callBack)
    {
        message_set("Malumotni o'chirishda cheklovlar mavjud");
        return redirect()->back();
    }
}
