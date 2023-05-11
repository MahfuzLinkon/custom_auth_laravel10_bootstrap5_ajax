<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function profile()
    {
//        return  DB::table('users')->where('id', session('loggedInUser'))->first();
        return view('profile.profile', [
            'userInfo' => DB::table('users')->where('id', session('loggedInUser'))->first(),
        ]);
    }

    public function profileEdit()
    {
        return view('profile.edit', [
            'userInfo' => DB::table('users')->where('id', session('loggedInUser'))->first(),
        ]);
    }
    // Profile update
    public function profileUpdate(Request $request){
        $user = User::where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'phone' => $request->phone,
        ]);
        return response()->json([
           'status' => 200,
           'message' => 'Profile updated successfully!'
        ]);
    }

    // update profile image
    public function profileImageUpdate(Request $request)
    {
//        print_r($_FILES);
//        print_r($_POST);
        $user_id = $request->user_id;
        $user = User::find($user_id);
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $fileUrl = 'assets/backend/images/profile/';
            $file->move($fileUrl, $fileName);
            if (file_exists($user->image)){
                unlink($user->image);
            }
        }
        User::where('id', $user_id)->update([
            'image' => $fileUrl.$fileName,
        ]);

        return response()->json([
           'status' => 200,
           'message' => 'Profile image updated !',
        ]);

    }
}
