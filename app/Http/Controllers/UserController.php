<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Rules\CurrentPasswordCheckRule;
use Illuminate\Http\Request;
use App\Services\LogWriter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
        abort_if(!auth()->user()->can('user.index'),403);
        $users = User::all();
        return view('admin.users.index',compact('users'));
    }

    // user create page
    public function create()
    {
        abort_if (!auth()->user()->can('user.create'),403);
        if (auth()->user()->hasRole('Super Admin'))
            $roles = Role::all();
        else
            $roles = Role::where('name','!=','Super Admin')->get();

        $companies = Company::with('branch')->get();
        $divisions = Division::all();
        $positions = Position::all();
        return view('admin.users.create',compact('roles','companies','divisions','positions'));
    }

    // user create
    public function store(Request $request)
    {
        abort_if (!auth()->user()->can('user.create'),403);
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'roles' => 'required',
        ]);
        $user = User::create($request->only('name','phone','company_id','branch_id','division_id','position_id','password'));

        User::whereId($user->id)->update([
            'password' => Hash::make($request->get('password'))
        ]);
        if ($request->hasFile('image')) {
            $string = preg_replace("/[^a-zA-Zа-яА-Я0-9]/ui", "", $user->name);
            $imageName = $user->id.'-'.$string.'.'.$request->image->extension();

            User::whereId($user->id)->update([
                'image' => $imageName
            ]);
            $request->image->move(public_path('uploads/avatar'),$imageName);

        }
        $user->assignRole($request->get('roles'));

        $activity = "\nCreated by: ".json_encode(auth()->user())
            ."\nNew User: ".json_encode($user)
            ."\nRoles: ".implode(", ",$request->get('roles'));

        LogWriter::user_activity($activity,'AddingUsers');
        message_set("Muvafaqqiyatli! User qo'shildi.",'success',5);

        return redirect()->route('user.index');
    }

    // user edit page
    public function edit($id)
    {
        abort_if((!auth()->user()->can('user.edit') && auth()->user()->id != $id),403);

        $user = User::find($id);

        if ($user->hasRole('Super Admin') && !auth()->user()->hasRole('Super Admin'))
        {
            message_set("У вас нет разрешения на редактирование администратора",'error',5);
            return redirect()->back();
        }

        if (auth()->user()->hasRole('Super Admin'))
            $roles = Role::all();
        else
            $roles = Role::where('name','!=','Super Admin')->get();

        $companies = Company::with('branch')->get();
        $divisions = Division::all();
        $positions = Position::all();
        return view('admin.users.edit',compact('user','roles','companies','divisions','positions'));
    }

    // update user dates
    public function update(Request $request, $id)
    {
        abort_if((!auth()->user()->can('user.update') && auth()->user()->id != $id),403);

        $activity = "\nUpdated by: ".logObj(auth()->user());
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'unique:users,phone,'.$id],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ]);

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

        if (isset($request->roles)) $user->syncRoles($request->get('roles'));
        unset($user->roles);

        $activity .="\nAfter updates User: ".logObj($user);
        $activity .=' Roles after: "'.implode(',',$user->getRoleNames()->toArray()).'"';

        LogWriter::user_activity($activity,'EditingUsers');
        message_set("Muvafaqqiyatli! User malumotlari o'zgartirildi.",'success',5);

        if (auth()->user()->can('user.edit'))
            return redirect()->route('user.index');
        else
            return redirect()->route('home');
    }

    // delete user by id
    public function destroy($id)
    {
        abort_if (!auth()->user()->can('user.destroy'),403);

        $user = User::find($id);
        if ($user->hasRole('Super Admin') && !auth()->user()->hasRole('Super Admin'))
        {
            message_set("У вас нет разрешения на редактирование администратора",'error',5);
            return redirect()->back();
        }
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        DB::table('model_has_permissions')->where('model_id',$id)->delete();
        $deleted_by = logObj(auth()->user());
        $user_log = logObj(User::find($id));
        $message = "\nDeleted By: $deleted_by\nDeleted user: $user_log";
        LogWriter::user_activity($message,'DeletingUsers');
        User::destroy($id);
        message_set("User o'chirib yuborildi",'warning',5);

        return redirect()->route('user.index');
    }

    public function profileShow()
    {
        return view('admin.users.show');
    }

    public function profilePassword(Request $request)
    {
//        dd($request->old_password.'   ->   '.$request->password.'='.$request->get('password'),Hash::check($request->old_password, auth()->user()->password),auth()->user()->password,Hash::make($request->password),Hash::check($request->password, Hash::make($request->password)));
        $validator = Validator::make($request->all(), [
            'old_password'      => 'required',
            'password'      => 'required|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            message_set("Old Password Doesn't match!",'error',5);

            return back()->with("error", "Old Password Doesn't match!");
        }

        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->password)
        ]);
        message_set("User parol malumoti o'zgartirildi",'success',5);

        return back()->with("status", "Password changed successfully!");
    }

    public function getUsersApi()
    {
        $user = auth()->user();
        if (!$user->can('user.indexApi')) return self::fail('user.index',["code" => 403, "message" => "у вас нет доступа"]);
        $users = User::where('branch_id',$user->branch_id)
            ->with('company:id,name,image','branch:id,name','position:id,name','division:id,name')->get();
        return self::good('get.users',$users);
    }

    public function storeApi(Request $request)
    {
        $auth = auth()->user();
        if (!$auth->can('user.storeApi')) return self::fail('user.create',["code" => 403, "message" => "у вас нет доступа"]);
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'phone'     => 'required|unique:users,phone',
            'password'  => 'required|string|min:4|confirmed'
        ]);
        if ($validator->fails()) {
            return self::fail('user.create', $validator->errors());
        }
        $data = $request->only('name','phone','division_id','position_id','password');
        $data['company_id'] = $auth->company_id;
        $data['branch_id'] = $auth->branch_id;
//        return $request->get('roles');
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
        if($auth->hasRole('President')&&$request->has('branch_id')){
            $user->update(['branch_id' => $request->branch_id]);
        }
        $user->assignRole($request->role);

        $activity = "\nCreated by: ".json_encode(auth()->user())
            ."\nNew User: ".json_encode($user)
            ."\nRoles: ".$request->role;

        LogWriter::user_activity($activity,'AddingUsers');

        return self::good('user.create',["code" => 200, "message" => "Пользователи успешна добавлен."]);
    }
}
