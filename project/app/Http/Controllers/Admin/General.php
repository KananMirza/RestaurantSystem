<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class General extends Controller
{
    public function getUsersList(){
        $users = User::where("roles","!=","1")->get();
        View::share('users', $users);
        return view('admin.users');
    }
    public function getEmpData(Request $request){
        $user = User::find($request->id);
        if($user){
            return $user;
        }
        return 0;
    }
    public function UserUpdate(Request $request){

        $request->validate([
            'edit_name'=>'required',
            'edit_position'=>'required',
            'edit_email'=>'required|email',
            'edit_password'=>'nullable|min:8'
        ]);
        $user = User::find($request->edit_id);
        $user->name = $request->edit_name;
        $user->email = $request->edit_email;
        if(strlen($request->edit_password) >= 8){
            $user->password = Hash::make($request->edit_password);
        }
        $user->roles = $request->edit_roles;
        $user->position = $request->edit_position;
        $user->status = $request->edit_status;

        $data = array(
            'title' => "RMS - New Password",
            'name' => $request->edit_name,
            'email' => $request->edit_email,
            'pass' => $request->edit_password,
            'view' => 'mails.new_password'
        );
        Mail::to(strtolower($request->edit_email))->send(new SendMail($data));
        return redirect()->back()->with( $user->save() ? "success" : "error", true);
    }

    public function UserAdd(Request $request){

        $request->validate([
            'name'=>'required',
            'position'=>'required',
            'email'=>'required|email|unique:users,email',
        ]);
        $pass = Str::random(8);

        $data = new User();
        $data->name = $request->name;
        $data->position = $request->position;
        $data->email = $request->email;
        $data->status = "1";
        $data->roles = $request->roles;
        $data->password = Hash::make($pass);



        $mail = array(
            'title' => "RMS - New Password",
            'name' => $request->name,
            'email' => $request->email,
            'pass' => $pass,
            'view' => 'mails.new_password'
        );
        Mail::to(strtolower($request->email))->send(new SendMail($mail));
        return redirect()->back()->with( $data->save() ? "success" : "error", true);
    }
}
