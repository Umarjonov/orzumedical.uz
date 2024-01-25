<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Auth;
use Exception;
use Socialite;
use App\Models\User;
use App\Http\Controllers\Controller;

class ProviderController extends Controller
{
    public function providerRedirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function providerCallback($provider)
    {
        try {

            $user = Socialite::driver($provider)->user();

            $searchUser = User::where('provider_id', $user->id)->first();

            if($searchUser){

                Auth::login($searchUser);

                return redirect('/dashboard');

            }else{
                $providerUser = User::updateOrCreate([
                    'email'             => $user->email,
                ],[
                    'name'              => $user->name,
                    'auth_type'         => $provider,
                    'provider_id'       => $user->id,
                    'avatar'            => preg_replace('/\?sz=[\d]*$/', '', $user->avatar),
                    'avatar_original'   => $user->avatar_original,
                    'password'          => encrypt('123456dummy')
                ]);

                Auth::login($providerUser);

                return redirect('/dashboard');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
