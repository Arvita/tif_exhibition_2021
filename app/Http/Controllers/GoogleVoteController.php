<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;;
use App\Models\User;
use Hash;

class GoogleVoteController extends Controller
{
    public function redirect($id)
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        // jika user masih login lempar ke home
        if (Auth::check()) {
            return redirect('/home');
        }
        

        $oauthUser = Socialite::driver('google')->user();
        $user = User::where('google_id', $oauthUser->id)->orWhere('email', $oauthUser->email)->first();
        
        if ($user) {
            if($user->google_id == null){
                $data_update = [
                    'google_id' => $oauthUser->id,
                    'avatar' => $oauthUser->avatar,
                ];
                User::where('email', $oauthUser->email)->update($data_update);
            }

            Auth::loginUsingId('$user->id');
            return redirect('/home');
        } else {
            $newUser = new User();
            $newUser->name = $oauthUser->name;
            $newUser->username = $oauthUser->name;
            $newUser->email = $oauthUser->email;
            $newUser->google_id= $oauthUser->id;
            $newUser->avatar = $oauthUser->avatar;
            $newUser->role = 2;
                // password tidak akan digunakan ;)
            $newUser->password = Hash::make($oauthUser->token);
            $newUser->save();
            Auth::login($newUser);
            return redirect('/home');
        }
    }
}
