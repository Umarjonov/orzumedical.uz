<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Track;
use App\Models\User;
use App\Services\LogWriter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        abort_if_api('user.indexApi');
        $user = auth()->user();
        if ( $user->hasRole('President') && \request()->has('branch_id') ){
            $branch_id = \request()->get('branch_id');
        }else{
            $branch_id = $user->branch_id;
        }
        $users = User::where(['company_id'=>$user->company_id, 'branch_id' => $branch_id ])
            ->with('company:id,name,image', 'branch:id,name', 'position:id,name', 'division:id,name', 'roles:name')
            ->get()->each(function ($user) {
                $user->role = $user->roles->first()->name;
                unset($user->roles);
            });
        return self::good('get.users',$users);
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
        abort_if_api('user.storeApi');
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'phone'     => 'required|unique:users,phone',
            'password'  => 'required|string|min:4|confirmed'
        ]);
        if ($validator->fails()) {
            return self::fail('user.create', $validator->errors());
        }
        $data = $request->only('name','phone','division_id','position_id','password');
        $auth = auth()->user();
        $data['company_id'] = $auth->company_id;
        if($auth->hasRole('President')&&$request->has('branch_id')){
            $data['branch_id'] = $request->branch_id;
        }else { $data['branch_id'] = $auth->branch_id; }
        $user = User::create($data);

        User::whereId($user->id)->update([
            'password' => Hash::make($request->get('password'))
        ]);
        if ($request->hasFile('image')) {
            $string = preg_replace("/[^a-zA-Zа-яА-Я0-9]/ui", "", $user->name);
            $imageName = $user->id.'-'.$string.'.'.$request->image->extension();
            $user->update(['image' => $imageName]);
            $request->image->move(public_path('uploads/avatar'),$imageName);
        }
        $rol = "employee";
        if($request->has('role')&&$request->role=="Director") $rol = "Director";

        $user->assignRole($rol);

        $activity = "\nCreated by: ".json_encode(auth()->user())
            ."\nNew User: ".json_encode($user)
            ."\nRoles: ".$rol;

        LogWriter::user_activity($activity,'AddingUsers');

        return self::good('user.create',["code" => 200, "message" => "Пользователи успешна добавлен."]);
    }

    public function profileUpdate(Request $request)
    {
        if ($request->filled('password') && $request->password == $request->password_confirmation) {
            User::find(auth()->id())->update([
                'password' => Hash::make($request->password)
            ]);
        } elseif ($request->filled('password')) {
            return self::fail('user.update', ["message" => "Пароли не совпадают.", "code" => 400]);
        }
//        return $request->image;
        if ($request->has('image')) {
            list($imageType, $imageData) = explode(";base64,", $request->image);
            list(, $imageType) = explode(":", $imageType);
            list(, $imageExtension) = explode("/", $imageType);

            $imageExtension = strtolower($imageExtension); // Convert to lowercase for consistency
            // You can allow all image extensions or add additional extensions as needed
            $allowedExtensions = ['jpeg', 'png', 'jpg', 'gif', 'bmp'];
            if (!in_array($imageExtension, $allowedExtensions)) {
                return $this->error_response2('Invalid image type. Allowed types are JPEG, PNG, JPG, GIF, BMP, etc.');
            }

            $binaryImage = base64_decode($imageData);

            if ($binaryImage === false) {
                return self::fail('user.update', ["message" => "Ошибка при загрузке изображения.", "code" => 400]);
            }

            $string = preg_replace("/[^a-zA-Zа-яА-Я0-9]/ui", "", auth()->user()->name);
            $imageName = auth()->id().'-'.$string.'.'.$imageExtension;
            $publicPath = public_path('uploads/avatar/'.$imageName);

            file_put_contents($publicPath, $binaryImage); // Save the image using file_put_contents

            User::find(auth()->id())->update([
                'image' => $imageName
            ]);
        }
        return self::good('user.update',["message" => "Пользователи успешна изменен.","code" => 200,'user'=> auth()->user()]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        abort_if_api('user.updateApi');
        $activity = "\nUpdated by: ".logObj(auth()->user());
        $validator = Validator::make($request->all(), [
            'name'      => 'string|max:255',
            'phone'     => 'unique:users,phone',
            'password'  => 'string|min:4|confirmed'
        ]);
        if ($validator->fails()) {
            return self::fail('user.update', $validator->errors());
        }
        $user = User::find($id);

        if ($request->get('password') != null)
        {
            User::whereId($id)->update([
                'password' => Hash::make($request->password)
            ]);
        }
        unset($request['password']);
        if ($request->hasFile('image')) {
            $string = preg_replace("/[^a-zA-Zа-яА-Я0-9]/ui", "", $user->name);
            $imageName = $user->id.'-'.$string.'.'.$request->image->extension();
            User::whereId($user->id)->update([
                'image' => $imageName
            ]);
            $request->image->move(public_path('uploads/avatar'),$imageName);
        }
        unset($request['image']);
        $activity .="\nBefore updates User: ".logObj($user);
        $activity .=' Roles before: "'.implode(',',$user->getRoleNames()->toArray()).'"';

        $user->fill($request->all());
        $user->save();
        if( $request->has('role') && ( $request->role == "Director" || $request->role == "employee" ) ){
            $user->assignRole($request->role);
        }

        $activity .="\nAfter updates User: ".logObj($user);
        $activity .=' Roles after: "'.implode(',',$user->getRoleNames()->toArray()).'"';

        LogWriter::user_activity($activity,'EditingUsers');
        return self::good('user.create',["code" => 200, "message" => "Пользователи успешна изменен."]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function user_check()
    {
        $user = auth()->user();
        $user->load('roles');
        $user->role = $user->roles->first()->name;
        unset($user->roles);
        return self::good('user.check', $user);
    }
    
}
