<?php
  
namespace App\Http\Controllers\Auth;
  
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Contracts\Auth\MustVerifyEmail;  
use Illuminate\Http\RedirectResponse;

class RegisteredProviderUserController extends Controller
{
   
   
    /*
    * Display the registration view.
    */
   public function create(Request $request): Response
   {
       
    //dd($request->provider);
    return Inertia::render('Auth/RegisterSocialite',[
        'email' => $request->email,
        'id' => $request->id,
        'name' => $request->name,
        'provider' => $request->provider
    ]);
   }

    
   
   
   /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $provider = false;
       // dd($request);
        switch($request->provider)
        {
            case 'facebook':
                $provider = 'facebook_id';
            break;
            case 'google':
                $provider = 'google_id';
            break;
        }

      //  dd($provider);
        $request->validate([
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'gender' => 'required',
            'birth_year' => 'required',
            'email' => 'required|string|email|max:255|unique:'.User::class,
        ]);

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'gender' => $request->gender,
            'birth_year' => $request->birth_year,
            'email' => $request->email,
            'password' => Hash::make('password'),
            $provider => $request->id
        ]);

       // $user = User::create($request->all());

        //event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }





    
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
    public function handleProviderCallback(String $provider,Request $request)
    {
        try {
        

            $user = Socialite::driver($provider)->user();
         
            $finduser = User::where($provider.'_id', $user->id)->first();
         
            if($finduser){
         
                Auth::login($finduser);
       
                return redirect()->intended('dashboard');
         
            }else{
               // dd($user);

                
                return redirect()->route('register-socialite',[
                    'id' => $user->id,
                    'email' => $user->email,
                    'name' => $user->name,
                    'provider' => $provider
                ]);
                /*
                return Inertia::render('Auth/RegisterSocialite', [
                    'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
                    'status' => session('status'),
                ]);*/
                
                
                
                
                
                /*
                
                $newUser = User::updateOrCreate(['email' => $user->email],[
                        'name' => $user->name,
                        'facebook_id'=> $user->id,
                        'password' => encrypt('password')
                    ]);*/
        
                //Auth::login($newUser);
        
                //return redirect()->intended('dashboard');
            }
       
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}