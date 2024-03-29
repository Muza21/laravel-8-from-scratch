<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        // var_dump(request()->all());
        // return request()->all();
        // ddd(request()->all());
        // create the user
        $attributes = request()->validate([
            'name' => ['required', 'max:255'],
            'username' => ['required', 'min:3', 'max:255', 'unique:users,username'],
            // 'username' => ['required', 'min:3', 'max:255', Rule::unique('users','username'),
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'min:7', 'max:255']
        ]);

        // $attributes['password'] = bcrypt($attributes['password']);

        $user=User::create($attributes);

        auth()->login($user);

        // session()->flash('success', 'Your account has been created');

        return redirect('/')->with('success', 'Your account has been created');
    }
}
