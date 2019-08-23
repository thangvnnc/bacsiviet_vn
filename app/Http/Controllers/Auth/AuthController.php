<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Users;
use App\Social;
use Auth;
use Validator;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback(Request $rq)
    {
        $user = Socialite::driver('facebook')->user();
       
         $social = Social::where('provider_user_id',$user->id)->where('provider','facebook')->first();
         
         if( $social){
            $u = Users::where('email',$user->email)->first();
            //Auth::login($u);
           
            $rq->session()->put('user',$u);
         }else{
            $temp = new Social;
            $temp->provider_user_id = $user->id;
            $temp->provider = 'facebook';
            $u = Users::where('email',$user->email)->first();
            if(!$u){
                $u = new Users;
                $u->fullname = $user->name;
                $u->email = $user->email;
                
                $u->save();
            }
            $temp->user_id = $u->user_id;
            $temp->save();

         }
        // if($social){
        //     $u = User::where('email',$user->email)->first();
        //     Auth::login($u);
            
        // }else{
        //     $temp = new Social;
        //     $temp->provider_user_id = $user->id;
        //     $temp->provider = 'facebook';

        //     $u = User::where('email',$user->email)->first();
        //     if(!$u){
        //         $u = User::create({
        //             'fullname' => $user->name,
        //             'email' =>$user->email
        //         })
        //     }
        //     $temp->user_id = $u->id;
        //     $temp->save();
        //     Auth::login($u);
            
        // }
        
        return redirect('/');
        // $user->token;
    }
}
