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
        $user = User::all()->where('login', $dados['login'])->first();
        Auth::login($user);
        return "feito";
    }

    public function verifica() {
        return json_encode(Auth::guest());
    }

    public function create() {
        User::create([
            'name' => 'Admin',
            'login' => '',
            'password' => md5("123456"),
        ]);
        return redirect()->action('LoginController@login');
    }

}
