<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function changePassword (Request $request){
        $findUser = User::where('id', $request->id);
        $request->validate([
            'password' => ['confirmed', 'min:6',' max:6', 'required'],
        ]);

        $findUser->update(['password' => Hash::make($request->password)]);
        Auth::logout();
        return redirect('/home');
        return redirect(route('home'))->with('password', 'updated');
    }
 }
