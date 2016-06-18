<?php

namespace cardial\Http\Controllers\Auth;

use cardial\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller {

    use ResetsPasswords;

    public function __construct() {
        $this->middleware($this->guestMiddleware());
    }

}
