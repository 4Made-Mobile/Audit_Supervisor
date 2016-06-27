<?php

namespace cardial\Http\Controllers;

use Request;
use Auth;
use cardial\User;

class LoginController extends Controller {

    public function form() {
        return view('login.form-login');
    }

    public function login() {
        $dados = Request::only('login', 'password');
        if (Auth::attempt($dados))
            return redirect('/');
        return redirect('/login');
    }

    public function verifica() {
        return json_encode(Auth::check());
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }

    public function create() {
        User::create([
            'name' => 'Admin',
            'login' => '',
            'password' => bcrypt("123456"),
        ]);
        return redirect()->action('LoginController@login');
    }

}
