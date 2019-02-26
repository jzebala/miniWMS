<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Auth;

class UserController extends Controller
{
    /**
     * Display the user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        if (Auth::user()->id == $id) {
            $user = User::findOrFail($id);
        } else {
            return redirect()->route('dashboard');
        }
        
        return view('user.show', compact('user'));
    }
}
