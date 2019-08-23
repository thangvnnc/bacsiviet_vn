<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use Auth;
use Illuminate\Support\MessageBag;

//social login
use Socialite;
use App\Users;

use App\Model\SocialAccount;

class LoginController extends Controller{
      
    //social login
    public function redirect($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function callback($social)
    {

        $user = Socialite::driver($social)->user();


        $socialAccount = SocialAccount::where('provider_user_id', $user->id)->where('provider', $social)->first();
        
        if($socialAccount){
            $u = Users::where('email', $user->email)->first();

            if($u!=null){                
                session()->put('user',$u);                
                return redirect('/');                
            }            
        }else{
            $tem = new SocialAccount();
            $tem->provider_user_id = $user->id;
            $tem->provider = $social;
            
            $u = Users::where('email', $user->getEmail())->first();           

            if(!$u){
               $u = Users::create([
                  'fullname' =>  $user->getName(),
                  'email' =>  $user->getEmail(),
                  'user_status' =>  1,
                  'user_type_id' =>  3                 
               ]); 
            }
            $u2 = Users::where('email', $user->getEmail())->first();  

            $tem->user_id = $u2->user_id;
            $tem->save();

            $user_login = Users::where('email',$u2->email)->first();

            if($user_login!=null){                
                session()->put('user',$user_login);                
                return redirect('/');                
            }

            //Auth::login($u2);
            return redirect('/');
        }
       
    }    
    
}

