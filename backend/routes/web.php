<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    if(Auth::check()) {
        return redirect('/index');
    }
    return view('login');
});
Route::get('/index', function () {
    return view('index');
});
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});
Route::post('/login', function(Request $request) {
    if (Auth::check()) {
        return redirect('/index');
    }
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        return redirect('/index');
    }
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
});
