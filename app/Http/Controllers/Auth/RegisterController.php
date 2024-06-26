<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class RegisterController extends Controller
{ 
    use RegistersUsers;
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = '/showRequestForm1';

    protected function redirectTo()
{
    if (auth()->user()->user_type == 1) {
        return '/showRequestForm1'; // صفحة مخصصة لنوع المستخدم 1
    } elseif (auth()->user()->user_type == 2) {
        return '/home'; // صفحة مخصصة لنوع المستخدم 2
    }
    elseif (auth()->user()->user_type == 3) {
        return '/home'; // صفحة مخصصة لنوع المستخدم 2
    }
   

    return '/home'; 
}


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            //'user_type' => ['required'],
        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
       
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'user_type' =>$data['user_type'],
        ]);
   
    }
}
