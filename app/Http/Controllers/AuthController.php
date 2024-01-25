<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
//use User model
use App\Models\User;

class AuthController extends Controller
{
    private static $methods = ['login','userCheck','register','otpCheck','setPassword','resetPassword','reset','resetOtpCheck'];

//    public function __construct()
//    {
//        $this->middleware('throttle:3,1')->only('register');
//    }

    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'method' => 'required',
            'params' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->validationError($validator->errors());
        }
        $method = self::method($request->get('method'));
        $check = self::checkMethod($method);
        if ( $check == 0 ){
            return self::fail($request->get('method'), [
                'code'      =>  4562,
                'message'   =>  'Такого метода не существует'
            ]);
        }
        return self::$method($request->get('params'));
    }

    public function login($params)
    {
        if ( $params['phone'] ?? 0 ){
            $params['phone'] = self::phone($params['phone']);
        }
        $validator = Validator::make($params, [
            'phone' => 'required|exists:users,phone',
            'password'  =>  'required',
            'device_name' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->validationError($validator->errors());
        }
        $user = User::where('phone',$params['phone'])->first();
        if (Hash::check($params['password'], $user->password) && !is_null($user)){
            Auth::login($user);
            // Revoke previous tokens
            $user->tokens()->where('name',$params['device_name'])->delete();
//            $access_token= DB::table('personal_access_tokens')->where(["tokenable_id"=>$user->id,"name"=>$params['device_name']])->delete();

            $token = $user->createToken($params['device_name'])->plainTextToken;
            $division = $user->division;
            return self::success('login',[
                'code'      =>200,
                'message'   =>'success auth',
                'user_name' =>  $user->name,
                'role'  =>  $user->getRoleNames()->first(),
                'avatar'    => $user->image,
                'division'  =>  $division->name??'',
                'access_token'  => $token,
                'token_type'    => 'Bearer'
            ]);
        }
        return self::fail('login',['code'=>403,'message'=>'password wrong']);
    }

    public function userCheck($params)
    {
        if ( $params['phone'] ?? 0 ){
            $params['phone'] = self::phone($params['phone']);
        }
        $validator = Validator::make($params, [
            'phone' => 'required|exists:users,phone'
        ]);
        if ($validator->fails()) {
            return $this->validationError($validator->errors());
        }
        $user = User::where('phone',$params['phone'])->first();
        return self::success('user.check',[
            'phone' =>  $params['phone'],
            'name'  =>  $user->name,
            'role'  =>  $user->getRoleNames(),
        ]);
    }

    public function register($params)
    {
        if ( $params['phone'] ?? 0 ){
            $params['phone'] = self::phone($params['phone']);
        }
        if ( $params['inn'] ?? 0 ){
            $params['inn'] = str_replace([' ', '_'], '', $params['inn']);
        }
        $validator = Validator::make($params, [
            'name'  => 'required',
            'phone' => 'required|unique:users,phone',
            'inn'   => 'required|unique:users,inn',
            'address'   =>  'required',
            'location'  =>  'required',
            'comp_name' => 'required',
//            'comp_address' => 'required',
//            'comp_fio'  => 'required',
//            'data'  => 'required',
            'mfo'   => 'required',
            'rc'    => 'required',
//            'nds'   => 'required',
//            'oked'  => 'required',
//            'phone2'=> 'required',
        ]);
        if ($validator->fails()) {
            return $this->validationError($validator->errors());
        }

        $otp = OTP::updateOrCreate([
            'phone' => $params['phone']
        ], [
            'otp' => Crypt::encrypt(random_int(10000, 99999)),
            'is_expired' => 0,
        ]);
        SmsGateway::run($otp);
        $partner = Counterparty::updateOrCreate([
            "inn" => $params['inn'],
            "phone" => $params['phone'],
            "status" => false,
        ], [
            "phone"     => $params['phone'],
            "name"      => $params['comp_name'],
            "address"   => $params['comp_address']??'',
            "register_date"     => $params['data']??'',
            "director"  => $params['comp_fio']??'',
            "mfo"       => $params['mfo'],
            "payment_account"   => $params['rc']??'',
            "payer_registration_code_vat" => $params['nds'],
            "oked"      => $params['oked']??'',
            "phone2"    => $params['phone2']??'',
            "data"      =>  json_encode($params)
        ]);
        return self::success('register',[
            "inn"       =>  $params['inn'],
            "phone"     =>  $params['phone'],
            "otp_send"  =>  true
        ]);
    }

    public function otpCheck($params)
    {
        if ( $params['phone'] ?? 0 ){
            $params['phone'] = self::phone($params['phone']);
        }
        if ( $params['inn'] ?? 0 ){
            $params['inn'] = str_replace([' ', '_'], '', $params['inn']);
        }
        $validator = Validator::make($params, [
            'phone' => 'required|unique:users,phone',
            'inn'   => 'required|unique:users,inn',
            'otp'   =>  'required',
        ]);
        if ($validator->fails()) {
            return $this->validationError($validator->errors());
        }
        $params['otp'] = str_replace([' ', '_'], '',$params['otp']);
        $otp = OTP::where('phone', $params['phone'])->first();
        if ($otp instanceof OTP) {
            if ($otp->is_expired == 1) {
                return self::fail('otp.check', [
                    'code'  =>  403,
                    'message' => 'Этот пароль устарел. Пожалуйста, получите новый пароль!'
                ]);
            }
            if (Crypt::decrypt($otp->otp) == $params['otp']) {
                $otp->update(['is_expired'=>1]);
                $partner = Counterparty::where([
                    "inn" => $params['inn'],
                    "phone" => $params['phone'],
                    "status" => false,
                ]);
                if ( !is_null($partner) ){
                    $partner->update(['status'=>true]);
                }else{
                    $partner = Counterparty::where([
                        "inn" => $params['inn'],
                        "phone" => $params['phone'],
                        "status" => true,
                    ]);
                }
                if ( is_null($partner) ){
                    return self::fail('otp.check', [
                        'code'  =>  404,
                        'message' => 'информация о партнере не найдена!сначала введите информацию о партнере'
                    ]);
                }

                return self::success('otp.check',[
                    "inn"       =>  $params['inn'],
                    "phone"     =>  $params['phone'],
                    "otp_check"  =>  true
                ]);
            }
        }
        return self::fail('otp.check', [
            'code'  =>  403,
            'message' => 'это неправильный пароль, попробуйте еще раз!'
        ]);
    }

    public function setPassword($params)
    {
        if ( $params['phone'] ?? 0 ){
            $params['phone'] = self::phone($params['phone']);
        }
        if ( $params['inn'] ?? 0 ){
            $params['inn'] = str_replace([' ', '_'], '', $params['inn']);
        }
        $validator = Validator::make($params, [
            'phone' => 'required|unique:users,phone',
            'inn'   => 'required|unique:users,inn',
            'password'   =>  'required|confirmed',
            'device_name' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->validationError($validator->errors());
        }

        $partner = Counterparty::where([
            "inn" => $params['inn'],
            "phone" => $params['phone'],
            "status" => true,
        ])->first();
        if ( !is_null($partner) ){
            $counterparty = json_decode($partner->data);
            $company = Company::updateOrCreate([
                "phone" => $params['phone'],
            ], [
                "inn" => $params['inn'],
                "name" => $counterparty->comp_name,
                "location" => $counterparty->location,
                "address" => $counterparty->address,
                "comp_address" => $counterparty->comp_address,
                "register_date" => $counterparty->data,
                "director" => $counterparty->comp_fio,
                "mfo" => $counterparty->mfo,
                "payment_account" => $counterparty->rc,
                "payer_registration_code_vat" => $counterparty->nds,
                "oked" => $counterparty->oked,
                "phone2" => $counterparty->phone2,
                "status" => false
            ]);
            $branch = Branch::create([
                'name'  =>  'Do`kon 1',
                'address'       =>  $counterparty->address,
                'location'      =>  $counterparty->location,
                'phone' =>  $counterparty->phone,
                'type'  =>  1,
                'company_id'    =>   $company->id ?? null
            ]);
            $user = User::create([
                'name'          =>  $company->director,
                'phone'         =>  $company->phone,
                'inn'           =>  $company->inn,
                'password'      =>  Hash::make($params['password']),
                'lang'          =>  'ru',
                'company_id'    =>  $company->id,
                'branch_id'     =>  $branch->id,
            ]);
            User::whereId($user->id)->update([
                'password' => Hash::make($params['password'])
            ]);
            $user->assignRole('Company director');
            Auth::loginUsingId($user->id);

            $content2 = "PosSystem\n Yangi partner ro'yxatdan o'tdi. Partner ma'lumotlari\nCompany: ".$company->name.PHP_EOL.'Director: '.$company->director.PHP_EOL.'Inn: '.$company->inn.PHP_EOL.'Phone: '.$company->phone;
            sendByTelegram($content2,'-708645906',"5392569306:AAHW_bpemoM8IuP43T6G0DH3Oqpcq4LC0l4");

            // Revoke previous tokens
            $user->tokens()->delete();
            $token = $user->createToken($params['device_name'])->plainTextToken;
            return self::success('set.password', [
                'code'      =>  200,
                'message'   =>  'success auth',
                'access_token'  => $token,
                'token_type'    => 'Bearer'
            ]);
        }
        return self::fail('set.password', [
            'code'  =>  404,
            'message' => 'информация о партнере не найдена!сначала введите информацию о партнере'
        ]);
    }

    public function reset($params)
    {
        if ( $params['phone'] ?? 0 ){
            $params['phone'] = self::phone($params['phone']);
        }
        $validator = Validator::make($params, [
            'phone' => 'required|exists:users,phone'
        ]);
        if ($validator->fails()) {
            return $this->validationError($validator->errors());
        }
        $otp = OTP::updateOrCreate([
            'phone' => $params['phone']
        ], [
            'otp' => Crypt::encrypt(random_int(10000, 99999)),
            'is_expired' => 0,
        ]);
        SmsGateway::run($otp);
        return self::success('reset.check',[
            "phone"     =>  $params['phone'],
            "otp_send"  =>  true
        ]);
    }

    public function resetOtpCheck($params)
    {
        if ( $params['phone'] ?? 0 ){
            $params['phone'] = self::phone($params['phone']);
        }
        $validator = Validator::make($params, [
            'phone' => 'required|exists:users,phone',
            'otp'   =>  'required',
        ]);
        if ($validator->fails()) {
            return $this->validationError($validator->errors());
        }
        $params['otp'] = str_replace([' ', '_'], '',$params['otp']);
        $otp = OTP::where('phone', $params['phone'])->first();
        if ($otp instanceof OTP) {
            if ($otp->is_expired == 1) {
                return self::fail('reset.otp.check', [
                    'code'  =>  403,
                    'message' => 'Этот пароль устарел. Пожалуйста, получите новый пароль!'
                ]);
            }
            if (Crypt::decrypt($otp->otp) == $params['otp']) {
                $otp->update(['is_expired'=>1]);
                $pass = random_int(10000, 99999);
                User::where('phone',$params['phone'])->update([
                    'remember_token'    =>  $pass
                ]);
                return self::success('reset.otp.check',[
                    "phone"         =>  $params['phone'],
                    "remember_otp"  =>  $pass,
                    "otp_check"     =>  true
                ]);
            }
        }
        return self::fail('reset.otp.check', [
            'code'  =>  403,
            'message' => 'это неправильный пароль, попробуйте еще раз!'
        ]);
    }

    public function resetPassword($params)
    {
        if ( $params['phone'] ?? 0 ){
            $params['phone'] = self::phone($params['phone']);
        }
        $validator = Validator::make($params, [
            'phone' => 'required|exists:users,phone',
            'remember_otp'   =>  'required',
            'password'   =>  'required|confirmed',
            'device_name' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->validationError($validator->errors());
        }
        $user = User::where('phone',$params['phone'])->first();
        if ( $user->remember_token == $params['remember_otp'] ){
            User::whereId($user->id)->update([
                'password' => Hash::make($params['password']),
                'remember_token'=>  null,
            ]);
            // Revoke previous tokens
            $user->tokens()->delete();
            $token = $user->createToken($params['device_name'])->plainTextToken;
            return self::success('reset.password', [
                'code'      =>  200,
                'message'   =>  'success auth',
                'access_token'  => $token,
                'token_type'    => 'Bearer'
            ]);
        }
        return self::fail('reset.password', [
            'code'  =>  403,
            'message' => 'oldin shaxsingizni tasdiqlang!'
        ]);
    }

    protected static function checkMethod($m){
        $i = 0;
        foreach ( self::$methods as $method){
            if ( $method == $m ){
                $i = 1;
            }
        }
        return $i;
    }

    public function userInfo()
    {
        $user = User::where('id',Auth::id())
            ->select('id','name','phone','company_id','branch_id','created_at')
            ->with('company:id,name,inn,director,phone,payer_registration_code_vat,mfo')
            ->with('branch:id,name,phone,type')->first();
//        get user role
        $user->role = $user->getRoleNames()[0];
        unset($user->roles);
        return self::success('user.info',$user);
    }

}
