<?php
namespace App\Http\Controllers;
use Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
class GoogleAuthController extends Controller
{
    public function signInwithGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callbackToGoogle()
    {
        try {
     
            $user = Socialite::driver('google')->user();
      
            $finduser = User::where('google_id', $user->id)->first();
      
            if($finduser){
      
                Auth::login($finduser);
     
                return redirect('/home');
      
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'gauth_type'=> 'google',
                    'password' => encrypt('admin@123')
                ]);
     
                Auth::login($newUser);
      
                return redirect('/home');
            }
     
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    public function index()
    {
        return redirect()->route('google.home');
    }
}