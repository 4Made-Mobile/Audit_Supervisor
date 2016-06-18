<?php

namespace cardial\Http\Controllers;

use cardial\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller {

    public function __construct() {
        
    }

    public function index() {
        return view('auth.login');
    }

}
