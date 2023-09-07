<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
class GoogleAuthController extends Controller
{
 
public function loginWithGoogle()

{
    return Socialite::driver('google')->redirect();
}
public function callbackfromgoogle()
{
    try{
       $user= Socialite::driver('google')->user();
       $isUser=User::where('email',$user->getEmail())->first();
       if(!$isUser)
       {
       $saveUser= User::UpdateOrCreate(
            [

                'google_id'=>$user->getId()
            ],
            [
                'name'=>$user->getName(),
                'email'=>$user->getEmail(),
                'password'=>Hash::make($user->getName().'@'.$user->getId()),

            ]
        );
       }
       else
       {
    $saveUser=  User::where('email',$user->getEmail())->update([

            'google_id'=>$user->getId(),
    ]);
    $saveUser=  $isUser=User::where('email',$user->getEmail())->first();
       }

       Auth::loginUsingId($saveUser->id);
       return view('home');

    }
    catch(\Throwable $th)
    {
        throw $th;
    }
}
}
