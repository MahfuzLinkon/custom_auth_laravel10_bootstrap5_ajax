<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function resetPassword()
    {
        return view('auth.reset-password');
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












}
