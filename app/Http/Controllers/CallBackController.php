<?php

namespace App\Http\Controllers;

use App\Models\CallBack;
use App\Models\Language;
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        //
    }
    public function leadsCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'branch_id' => 'required|exists:branches,id',
        ],[
            'name.required' => 'Поле "Имя" обязательно для заполнения.',
            'phone.required' => 'Поле "Телефон" обязательно для заполнения.',
            'branch_id.required' => 'Поле "Филиал" обязательно для заполнения.',
            'branch_id.exists' => 'Выбранный филиал не существует.',
        ]);
        if ($validator->fails()) {
            return self::fail('user.update',["message"=>$validator->errors()->first(),'code'=>403]);
        }
        $lead = CallBack::create($request->only("name","phone","branch_id"));
        $branch_name = Language::where('key',"branches.$lead->branch_id.name")->first()->ru;
        $content = "OrzuClinic\n'Новая заявка' 'Yangi foydalanuvchi' 🔔\nИмя: ".$lead->name.PHP_EOL.'Телефон: '.$lead->phone.PHP_EOL.'Филиал: '.$branch_name;
        sendByTelegram($content,'-1002467823652',"7874252321:AAFBeA353Q0POd8R96fjILPpT_FlbrvD02E");

        return self::good("leads.create",["message"=>"success","code"=>200]);
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
