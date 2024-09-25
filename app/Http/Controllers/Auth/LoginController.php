<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function login(Request $request){
        $validatedData = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = array();
        $credentials['email'] = $request->email;
        $credentials['password'] = $request->password;
        $credentials['remember'] = $request->remember;
        $remember = $credentials['remember'] ?? false;
        unset($credentials['remember']);
        if (Auth::attempt($credentials, $remember)) {
            if(Auth::user()->type == 'admin'){
                return redirect()->route('adminHome');
            }
            else if(Auth::user()->type == 'supervisor'){
                return redirect()->route('supervisorHome');
            }
            else if(Auth::user()->type == 'stuff'){
                return redirect()->route('home');
            }
        }
        else{
            $this->incrementLoginAttempts($request);

            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
