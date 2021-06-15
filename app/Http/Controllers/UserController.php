x<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
  
    public function index()
    {
        if(Auth::check())
        {
            return redirect()->route('userProfile');
        }
        return view('user.index');
    }

    public function loginPage()
    {
        if(Auth::check())
        {
            return redirect()->route('userProfile');
        }

        return view('user.loginPage');
    }

    public function registerPage()
    {
        if(Auth::check())
        {
            return redirect()->route('userProfile');
        }
       return view('user.registerPage');
    }
    
    public function postRegister(Request $request)
    {
        if(Auth::check())
        {
            return redirect()->route('userProfile');
        }

        $request->validate([
            'fname'=>'required',
            'lname'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'
        ],
        [
            'password.regex'=> 'Your password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character.'
        ]);
        

        $user = new User();
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();


        return redirect()->route('loginPage')->with('success', 'Register Successfully Login TO Contiune');
    }

    public function postLogin(Request $request)
    {
        if(Auth::check())
        {
            return redirect()->route('userProfile');
        }
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'
        ],
        [
            'password.regex'=> 'Your password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character.'
        ]);

        $data = $request->all();
        $checkEmail = User::where('email', $data['email'])->count();

        if($checkEmail >0)
        {
            if(Auth::attempt(['email'=>$data['email'], 'password' =>$data['password']]))
            {
                
                return redirect()->route('userProfile')->with('success', 'Welcome back');
                
            }
            else
            {
                return redirect()->route('loginPage')->with('error', 'Login failed');
            }
        }
        else
        {
            return redirect()->route('loginPage')->with('error', 'Email does not exit Please Register first to Login');
            
        }
    }

    public function userProfile()
    {
        if(Auth::check())
        {
            $user = Auth::user();
            return view('user.profile', compact('user'));
        }
        else
        {
            return redirect()->route('loginPage')->with('error', 'Login to contiune');
        }
    }

    public function userProfileEdit()
    {
        if(Auth::check())
        {
            $user = Auth::user();
            return view('user.updateProfile', compact('user'));
        }
        else
        {
            return redirect()->route('loginPage')->with('error', 'Login to contiune');
        }
    }

    public function userProfileUpdate(Request $request)
    {
        if(Auth::check())
        {
            
            $request->validate([
                'fname'=>'required',
                'lname'=>'required',
                'email' => 'required|email|exists:users',
            ]);
            
            $id = Auth::id();

            $user = User::find($id);
            $user->fname = $request->fname;
            $user->lname = $request->lname;
            $user->email = $request->email;
            $user->save();

            return redirect()->route('userProfile')->with('success', 'profile updated successfully');


        }
        else
        {
            return redirect()->route('loginPage')->with('error', 'Login to contiune');
        }
    }
    

    public function userProfileDelete()
    {
        if(Auth::check())
        {
            $id = Auth::id();
            $user = User::find($id);
            $user->delete();
            return redirect('login')->with('success', 'Account Deleted Successfully');
        }
        else
        {
            return redirect()->route('loginPage')->with('error', 'Login to contiune');
        }
    }

    public function resetPasswordPage()
    {
        if(Auth::check())
        {
            $user = Auth::user();
            return view('user.resetPasswordPage', compact('user'));   
        }
        else
        {
            return redirect()->route('loginPage')->with('error', 'Login to contiune');
        }
    }

    public function postEmail(Request $request)
    {   
        if(Auth::check())
        {
            $request->validate([
                'email' => 'required|email|exists:users',
            ]);

            $token =  $request->_token;
            $email = $request->email;
            DB::table('password_resets')->insert(
                ['email' => $email, 
                'token' => $token, 
                'created_at' => Carbon::now()]
            );
            
            Mail::to($email)->send(new PasswordReset($token));
            return redirect()->back()->with('success', 'Check Your Mail to reset password!.');
        }
        else
        {
            return redirect()->route('loginPage')->with('error', 'Login to contiune');
        }
    }

 
    public function confirmPasswordPage($token)
    {
        if(Auth::check())
        {
            $tokenExits = DB::table('password_resets')->where('token', $token)->count();
            if($tokenExits > 0)
            {
                return view('user.confirmPassword', compact('token'));   
            }
            else
            {
                return 'Link Expired Please Try again!';
            }
        }
        else
        {
            return redirect()->route('loginPage')->with('error', 'Login to contiune');
        }
        
    }   
    
    public function postConfirmPasswordPage(Request $request)
    {
        if(Auth::check())
        {
            $request->validate([
                'newpassowrd' => 'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'
            ],
            [
                'newpassowrd.regex'=> 'Your password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character.'
            ]);

            $id = Auth::id();

            $user = User::find($id);
            $user->password = Hash::make($request->newpassowrd);
            $user->save();

            $token =  $request->paswordToken;
            DB::table('password_resets')->where('token', $token)->delete();
            
            
            return redirect()->route('userProfile')->with('success', 'reset password done successfully!.');
        }
        else
        {
            return redirect()->route('loginPage')->with('error', 'Login to contiune');
        }
    }

    
    public function logout() 
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('home')->with('success', 'Logout Successfully');
    }
}
