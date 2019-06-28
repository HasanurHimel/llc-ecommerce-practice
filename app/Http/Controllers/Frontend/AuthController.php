<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Notifications\UserRegister;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function showRegisterForm(){
        return view('Frontend.registration.showRegister');
    }
    public function proccessRegister(Request $request){
        $user=$request->all();
        $validator=Validator::make($user,[
          'name'=>'required|min:2|max:50|unique:users',
          'email'=>'required|min:2|max:50|email|unique:users',
          'password'=>'required|min:6',
          'mobile'=>'required|numeric',
        ]);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
           $user= User::create([
                'name'=>trim($request->name),
                'email'=>strtolower(trim($request->email)),
                'password'=>trim(bcrypt($request->password)),
                'phone_number'=>trim($request->mobile),
                'email_verification_token'=>uniqid(time(), true).str_random(32)
            ]);

            $user->notify(new UserRegister($user));

            $this->setSuccess('Please check your email, and verify your email');
            return redirect()->route('login');

        }catch (\Exception $e){
            $this->setWarning('Please valid input');
            return redirect()->back();
        }




    }

    public function showLoginForm(){
        return view('Frontend.registration.loginForm');
    }

    public function activateUser ($token){
        if ($token ==null){
            $this->setWarning('please varify first to login ..!!');
            return redirect()->route('login');
        }
        $user=User::where('email_verification_token', $token)->first();
        if ($user ==null){
            $this->setWarning('please give your valid token ..!!');
            return redirect()->route('login');
        }

        $user->update([
            'email_verified_at'=>Carbon::now(),
            'email_verification_token'=>'',
        ]);
        $this->setSuccess('Thank you, Your email is varified now you can login..!');
        return redirect()->route('login');

    }

    public function proccessLogin(Request $request){
        $validator=Validator::make($request->all(), [
           'email'=>'required|email',
            'password'=>'required'
        ]);
        if ($validator->fails()){
            $this->setWarning('Invalid email or password, Please give your valid information');
            return redirect()->route('login');

        }

        $credentials=$request->only(['email', 'password']);;
        if (auth()->attempt($credentials)){
            $user=auth()->user();

            if ( $user->email_verified_at == null && $user->email_verification_token !=null ){
                $this->setWarning('Please verify your account');
                return redirect()->back();
            }
            $this->setSuccess('You are logged in');
            return redirect('/');

        }
        $this->setWarning('Invalid email or password, please input your valid credentials..!!');
        return redirect()->back();
    }

    public function logout(){
        auth()->logout();
        $this->setSuccess('Account Logged out ');
        return redirect()->route('login');

    }


}
