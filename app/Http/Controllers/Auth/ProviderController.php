<?php
  
namespace App\Http\Controllers\Auth;
  
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
  
class ProviderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToProvider(String $provider)
    {
       
        return Socialite::driver($provider)->redirect();
    }
           
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleProviderCallback(String $provider)
    {
        try {
        

            $user = Socialite::driver($provider)->user();
         
            $finduser = User::where($provider.'_id', $user->id)->first();
         
            if($finduser){
         
                Auth::login($finduser);
       
                return redirect()->intended('dashboard');
         
            }else{
                $newUser = User::updateOrCreate(['email' => $user->email],[
                        'name' => $user->name,
                        'facebook_id'=> $user->id,
                        'password' => encrypt('password')
                    ]);
        
                Auth::login($newUser);
        
                return redirect()->intended('dashboard');
            }
       
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}