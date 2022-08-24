<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{

    public function create(){
        return view('sessions.create');
    }

    public function store(){
        $attributes = request()->validate([
            'email'=> 'required|email',
            'password' => 'required'
        ]);

        if(!auth()->attempt($attributes)){// auth failed.
            throw ValidationException::withMessages([
                'email'=>'Your provided credentials could not be identified.'
            ]);
        
        // return back()
        //     ->withInput()
        //     ->withErrors(['email'=>'Your provided credentials could not be identified.']);
        }

        return redirect('/')->with('success','Welcome Back!');

        
    }

    public function destroy(){
        auth()->logout();

        return redirect('/')->with('success','Goodbye!');
    }
}
