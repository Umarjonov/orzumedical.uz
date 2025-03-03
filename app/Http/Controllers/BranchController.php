<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Branch::all();
        return view('admin.branches.index',compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.branches.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if_forbidden('branch.store');
        $validator = Validator::make($request->all(), [
            'name_uz' => 'required',
            'name_ru' => 'required',
            'description_uz' => 'required',
            'description_ru' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'address' => 'required',
            'address_ru' => 'required',
            'status' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'price' => 'required',
        ]);
        if ($validator->fails()) {
            message_set($validator->errors()->first(),'danger',5);
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data= $request->only(['phone','address','status','price']);
        $data['location'] = $request->latitude.','.$request->longitude;
        $branch = Branch::create($data);
        if ($request->hasFile('image')) {
            $imageName = $branch->id.'-branch.'.$request->image->extension();
            Branch::whereId($branch->id)->update([
                'image' => $imageName
            ]);
            $request->image->move(public_path('uploads/images/branches'),$imageName);
        }
        $languages = [
            [
                "key"=>"branches.".$branch->id.".name",
                "uz"=>$request->name_uz,
                "ru"=>$request->name_ru,
            ],
            [
                "key"=>"branches.".$branch->id.".description",
                "uz"=>$request->description_uz,
                "ru"=>$request->description_ru,
            ],
            [
                "key"=>"branches.".$branch->id.".address",
                "uz"=>$request->address,
                "ru"=>$request->address_ru,
            ],
        ];
        Language::insert($languages);
        message_set("Branch yaratildi",'success',5);
        return redirect()->route('branches.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        $language = Language::where('key','branches.'.$branch->id.'.name')->first();
        $branch->name_uz = $language->uz??'';
        $branch->name_ru = $language->ru??'';
        $language = Language::where('key','branches.'.$branch->id.'.description')->first();
        $branch->description_uz = $language->uz??'';
        $branch->description_ru = $language->ru??'';
        $language = Language::where('key','branches.'.$branch->id.'.address')->first();
        $branch->address_ru = $language->ru??'';
        $branch->latitude = explode(',',$branch->location)[0];
        $branch->longitude = explode(',',$branch->location)[1];
        return view('admin.branches.edit',compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        $validate = Validator::make($request->all(), [
            'name_uz' => 'required',
            'name_ru' => 'required',
            'phone' => 'required',
            'description_uz' => 'required',
            'description_ru' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'address' => 'required',
            'address_ru' => 'required',
            'status' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'price' => 'required',
        ]);
        if ($validate->fails()) {
            message_set($validate->errors()->first(),'danger',5);
            return redirect()->back()->withErrors($validate)->withInput();
        }
        $data= $request->only(['phone','address','status','price']);
        $data['location'] = $request->latitude.','.$request->longitude;
        $branch->update($data);
        if ($request->hasFile('image')) {
            $imageName = $branch->id.'-branch.'.$request->image->extension();
            Branch::whereId($branch->id)->update([
                'image' => $imageName
            ]);
            $request->image->move(public_path('uploads/images/branches'),$imageName);
        }
        Language::updateOrCreate(
            ['key'=>'branches.'.$branch->id.'.name'],
            [
                "uz"=>$request->name_uz,
                "ru"=>$request->name_ru,
            ]
        );
        Language::updateOrCreate(
            ['key'=>'branches.'.$branch->id.'.description'],
            [
                "uz"=>$request->description_uz,
                "ru"=>$request->description_ru,
            ]
        );
        Language::updateOrCreate(
            ['key'=>'branches.'.$branch->id.'.address'],
            [
                "uz"=>$request->address,
                "ru"=>$request->address_ru,
            ]
        );
        message_set("Branch o'zgartirildi",'success',5);
        return redirect()->route('branches.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        Language::where('key','like','branches.'.$branch->id.'.%')->delete();
        $branch->delete();
        message_set("Branch o'chirildi",'success',5);
        return redirect()->route('branches.index');
    }
}
