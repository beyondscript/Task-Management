<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\User;

class SettingsController extends Controller
{
    public function adminChangeEmail(){
        return view('admin.changeEmail');
    }

    public function adminUpdateEmail(Request $request){
        $validated = $request->validate([
            'password' => ['required', 'string', 'min:8'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        if (Hash::check($request->password, Auth::user()->password)){
            $user = User::findorfail(Auth::user()->id);
            $user->email = $request->email;
            $user->save();

            $notification = array(
                'message' => 'Email address successfully changed',
                'alert-type' => 'info'
            );
            return Redirect()->route('adminHome')->with($notification);
        }
        else{
            $notification = array(
                'message' => 'Current password do not match',
                'alert-type' => 'info'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function adminChangePassword(){
        return view('admin.changePassword');
    }

    public function adminUpdatePassword(Request $request){
        $validated = $request->validate([
            'current_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (Hash::check($request->current_password, Auth::user()->password)){
            $user = User::findorfail(Auth::user()->id);
            $user->password = Hash::make($request->password);
            $user->save();

            $notification = array(
                'message' => 'Password successfully changed',
                'alert-type' => 'info'
            );
            return Redirect()->route('adminHome')->with($notification);
        }
        else{
            $notification = array(
                'message' => 'Current password do not match',
                'alert-type' => 'info'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function supervisorChangeEmail(){
        return view('supervisor.changeEmail');
    }

    public function supervisorUpdateEmail(Request $request){
        $validated = $request->validate([
            'password' => ['required', 'string', 'min:8'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        if (Hash::check($request->password, Auth::user()->password)){
            $user = User::findorfail(Auth::user()->id);
            $user->email = $request->email;
            $user->save();

            $notification = array(
                'message' => 'Email address successfully changed',
                'alert-type' => 'info'
            );
            return Redirect()->route('supervisorHome')->with($notification);
        }
        else{
            $notification = array(
                'message' => 'Current password do not match',
                'alert-type' => 'info'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function supervisorChangePassword(){
        return view('supervisor.changePassword');
    }

    public function supervisorUpdatePassword(Request $request){
        $validated = $request->validate([
            'current_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (Hash::check($request->current_password, Auth::user()->password)){
            $user = User::findorfail(Auth::user()->id);
            $user->password = Hash::make($request->password);
            $user->save();

            $notification = array(
                'message' => 'Password successfully changed',
                'alert-type' => 'info'
            );
            return Redirect()->route('supervisorHome')->with($notification);
        }
        else{
            $notification = array(
                'message' => 'Current password do not match',
                'alert-type' => 'info'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function changeEmail(){
        return view('stuff.changeEmail');
    }

    public function updateEmail(Request $request){
        $validated = $request->validate([
            'password' => ['required', 'string', 'min:8'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        if (Hash::check($request->password, Auth::user()->password)){
            $user = User::findorfail(Auth::user()->id);
            $user->email = $request->email;
            $user->save();

            $notification = array(
                'message' => 'Email address successfully changed',
                'alert-type' => 'info'
            );
            return Redirect()->route('home')->with($notification);
        }
        else{
            $notification = array(
                'message' => 'Current password do not match',
                'alert-type' => 'info'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function changePassword(){
        return view('stuff.changePassword');
    }

    public function updatePassword(Request $request){
        $validated = $request->validate([
            'current_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (Hash::check($request->current_password, Auth::user()->password)){
            $user = User::findorfail(Auth::user()->id);
            $user->password = Hash::make($request->password);
            $user->save();

            $notification = array(
                'message' => 'Password successfully changed',
                'alert-type' => 'info'
            );
            return Redirect()->route('home')->with($notification);
        }
        else{
            $notification = array(
                'message' => 'Current password do not match',
                'alert-type' => 'info'
            );
            return Redirect()->back()->with($notification);
        }
    }
}
