<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function loginIndex()
    {
        return view('auth.login');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }
    public function login2(Request $request)
    {
        $credentials['phone'] = $request->has('phone') ? self::phone($request->get('phone')) : '';
        $credentials['password'] = $request->get('password') ?? '';
        $validator = Validator::make($credentials, [
            'phone' => 'required|exists:users,phone',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $user = User::where('phone',$credentials['phone'])->first();
        if (Hash::check($credentials['password'], $user->password) && !is_null($user)){
            Auth::login($user, $request->get('remember'));
            return redirect()->route('home');
        }
        return redirect()->back()->withErrors(['password'=>'неверный пароль'])->withInput();
    }

    public function forget()
    {
        return view('admin.auth.reset');
    }

    public function forgetPost(Request $request)
    {
        $phone = $request->has('phone') ? self::phone($request->get('phone')) : '';
        $user = User::where('phone',$phone)->first();
        if ( is_null($user) ){
            return redirect()->back()
                ->withErrors(['phone'=>'Bunday telofon raqam ro`yxatdan o`tmagan'])
                ->withInput();
        }
        $otp = OTP::updateOrCreate([
            'phone' => $phone
        ], [
            'otp' => Crypt::encrypt(random_int(10000, 99999)),
            'is_expired' => 0,
        ]);
        SmsGateway::run($otp);
        $request->session()->put('phone', $phone);
        return redirect()->route('auth.forget.check');
    }

    public function forgetCheck(Request $request)
    {

        if ($request->session()->has('phone')) {
            return view('admin.auth.check');
        }
        message_set("Iltimos oldin telfon raqamni kiriting.", 'error', 5);

        return view('admin.auth.reset');

    }

    public function forgetCheckResend(Request $request)
    {

        if ($request->session()->has('phone')) {
            return view('admin.auth.check');
        }
        message_set("Iltimos oldin telfon raqamni kiriting.", 'error', 5);

        return view('admin.auth.reset');

    }
    public function forgetCheckPost(Request $request)
    {
        $this->validate($request, [
            'otp' => 'required'
        ]);
        if (!$request->session()->has('phone')) {
            message_set("Iltimos oldin telfon raqamni kiriting.", 'error', 5);
            return view('admin.auth.reset');
        }
        $otp_code = str_replace([' ', '_'], '', $request->get('otp'));
        $otp = OTP::where('phone', $request->session()->get('phone'))->first();
        if ($otp instanceof OTP) {
            if ($otp->is_expired == 1) {
                message_set("Bu parol eskirgan. Iltimos yangi parol oling!.", 'error', 5);
                return view('admin.auth.reset');
            }
            if ( Crypt::decrypt($otp->otp) == $otp_code ) {
                $otp->update(['is_expired' => true]);
                $request->session()->put('otp', true);
                return redirect()->route('auth.set.password');
            }
        }

        message_set("Kod xato kiritildi. Iltimos qaytadan urining", 'error', 3);
        return view('admin.auth.check');
    }

    public function setPassword(Request $request)
    {
        if (!$request->session()->has('phone')) {
            message_set("Iltimos oldin telfon raqamni kiriting.", 'error', 5);
            return view('admin.auth.reset');
        }
        if ( $request->session()->has('otp') && $request->session()->get('otp') ) {
            return view('admin.auth.set-password');
        }

        message_set("Kod xato kiritildi. Iltimos qaytadan urining", 'error', 3);
        return view('admin.auth.check');
    }

    public function setPasswordPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if (!$request->session()->has('phone')) {
            message_set("Iltimos oldin telfon raqamni kiriting.", 'error', 5);
            return view('admin.auth.reset');
        }
        if ( $request->session()->has('otp') && $request->session()->get('otp') != true ) {
            message_set("Kod xato kiritildi. Iltimos qaytadan urining", 'error', 3);
            return view('admin.auth.check');
        }
//        #Update the new Password
        $user = User::where('phone',$request->session()->get('phone'))->first();
        User::whereId($user->id)->update([
            'password' => Hash::make($request->password)
        ]);
        $request->session()->forget('phone');
        $request->session()->forget('otp');
        Auth::login($user);
        message_set("User parol malumoti o'zgartirildi", 'success', 3);
        return view('admin.users.show');

    }
}
