<?php

namespace App\Http\Controllers;

use App\Mail\newAdmin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }

    public function newAdmin(){
        $admins = User::where('isAdmin', '=', 0)->get();
        return view('admin.new_admin', compact('admins'));
    }

    public function storeAdmin(Request $request){

        $input = $request->all();
        $input['verification_code'] = User::generateVerificationCode();

        $this->validate(request(), [
          'firstname' => 'required|min:2',
          'lastname'=> 'required|min:2',
          'email' => 'required|string|email|max:255|unique:users'
        ]);

        $admin = User::create($input);

        Mail::to($admin)->send(new newAdmin($admin));

        flash('An email has been sent to the user. Once they complete the registration, your new admin will be able to login.')->success();

        return redirect()->back();
    }

    public function verify($token){
        $user = User::where('verification_code', $token)->firstOrFail();

        $user->verification_code = null;

        $user->save();

        return view('auth/register', compact('user'));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
          'firstname' => 'required|string|max:255',
          'lastname' => 'required|string|max:255',
          'email' => 'required|string|email|max:255',
          'password' => 'required|string|min:5|confirmed',
        ]);
        $user = User::findOrFail($request['user_id']);

        $user->update([
          'firstname' => $request['firstname'],
          'lastname' => $request['lastname'],
          'email' => $request['email'],
          'password' => bcrypt($request['password']),
        ]);

        auth()->login($user);

        return redirect('/admin');
    }

    public function destroy($id){
        User::find($id)->delete();

        return redirect()->back();
    }
}
