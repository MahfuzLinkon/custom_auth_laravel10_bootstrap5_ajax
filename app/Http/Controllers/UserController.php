<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function register()
    {
        if (session()->has('loggedInUser')){
            return redirect()->back();
        }
        return view('auth.register');
    }

    public function forgot()
    {
        if (session()->has('loggedInUser')){
            return redirect()->back();
        }
        return view('auth.forgot-password');
    }

    public function resetPassword(Request $request)
    {
        return view('auth.reset-password', [
            'email' => $request->email,
            'token' => $request->token,
        ]);
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'new_password' => 'required|min:6|max:50',
            'c_new_password' => 'required|same:new_password',
        ],[
           'c_new_password.same' => 'Password does not match',
           'c_new_password.required' => 'New confirm password is required'
        ]);
        if ($validator->fails()){
            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag(),
            ]);
        }else{
            $user  = DB::table('users')->where('email', $request->email)->whereNotNull('token')
                ->where('token', $request->user_token)->where('token_expire', '>', Carbon::now())->exists();
            if ($user){
                User::where('email', $request->email)->update([
                    'password' => Hash::make($request->new_password),
                    'token' => null,
                    'token_expire' => null,
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => "Password changed successfully! <br> <a href='/'>Login Now</a>",
                ]);
            }else{
                return response()->json([
                    'status' => 401,
                    'message' => 'Reset password link expired!',
                ]);
            }
        }
    }

    public function registerUser(Request $request)
    {
//        print_r($_POST);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:50',
            'c_password' => 'required|same:password',
        ],[
            'c_password.same' => 'Password did not match',
            'c_password.required' => 'Confirm password is required!',
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag(),
            ]);
        }else{
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            return response()->json([
               'status' =>200,
               'message' => 'Registered successfully',
            ]);
        }
    }

    public function loginUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        if ($validator->fails()){
            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag(),
            ]);
        }else{
            $user = User::where('email', $request->email)->first();
            if ($user){
                if (Hash::check($request->password, $user->password)){
                    $request->session()->put('loggedInUser', $user->id);
                    return response()->json([
                       'status' => 200,
                       'message' => 'Login Successfully !'
                    ]);
                }else{
                    return response()->json([
                       'status' => 401,
                       'message' => 'Email or password does not match !',
                    ]);
                }
            }else{
                return response()->json([
                    'status' => 401,
                    'message' => 'User not found !',
                ]);
            }
        }
    }

    public function dashboard()
    {
        return view('dashboard.dashboard', [
            'userInfo' => DB::table('users')->where('id', session('loggedInUser'))->first(),
        ]);
    }

    public function logout()
    {
        if (session()->has('loggedInUser')){
            session()->pull('loggedInUser');
            return redirect('/');
        }
    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'email' => 'required|email',
        ]);
        if ($validator->fails()){
            return response()->json([
               'status' =>  400,
                'messages' =>$validator->getMessageBag(),
            ]);
        }else{
            $token = Str::uuid();
            $user = DB::table('users')->where('email', $request->email)->first();
            $details = [
                'body' => route('reset', ['email'=> $request->email, 'token' => $token])
            ];
            if ($user){
                User::where('email', $request->email)->update([
                    'token' => $token,
                    'token_expire' => Carbon::now()->addMinutes(10)->toDateTimeString(),
                ]);
                Mail::to($request->email)->send(new ForgotPassword($details));
                return response()->json([
                    'status' => 200,
                    'message' => 'Reset password link has been sent to your e-mail !',
                ]);
            }else{
                return response()->json([
                   'status' => 401,
                   'message' => 'This email is not register with us!',
                ]);
            }
        }
    }












}
