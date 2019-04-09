<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Auth;
use Hash;

class UserController extends Controller
{
    /**
     * Display the user.
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function show($name) {

        // Get user by name
        $user = User::where('name', $name)->firstOrFail();

        // Return user only logged in
        if (Auth::user()->id == $user->id) {
            return view('user.show', compact('user'));
        }

        return redirect()->route('dashboard');
    }

    /**
     * Show the form for changing password.
     *
     * @return \Illuminate\Http\Response
     */
    public function changePasswordForm($name)
    {
        // Get user by name
        $user = User::where('name', $name)->firstOrFail();

        if (Auth::user()->id != $user->id) {
            return redirect()->route('user.show', Auth::user()->name);
        }

        return view('user.changePasswordForm', compact('user'));
    }

    /**
     * Change password for user
     *
     * @param string $name
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword($name, Request $request) {

        // Get user by name
        $user = User::where('name', $name)->firstOrFail();

        // Only logged in user can change password.
        if (Auth::user()->id != $user->id) {
            return redirect()->route('user.changePasswordForm', Auth::user()->name)->with('dangerMsg', 'Upss..., coś poszło nie tak!');
        }
        
        $this->validate($request, [
            'password' => 'required',
            'new_password' => 'required|min:8|confirmed|different:password',
            'new_password_confirmation' => 'required|min:8'
        ]);

        // The password is the same as the user password
        if (Hash::check($request->password, $user->password)) {
            
            $user->password = Hash::make($request->new_password);
            $user->save();

            // Success !!!
            return redirect()->route('user.show', Auth::user()->name)->with('successMsg', 'Hasło zostało zmienione!');
        } else {
            
            return redirect()->route('user.changePasswordForm', Auth::user()->name)->with('dangerMsg', 'Upss..., coś poszło nie tak!');
        }
    }
}
