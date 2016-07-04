<?php

namespace cardial\Http\Controllers;

use cardial\Http\Requests\PerguntaRequest;
use cardial\Pergunta;

class FormularioController extends Controller {

        public function novo()
        {
            return view('formulario.form-novo');
        }
    
}