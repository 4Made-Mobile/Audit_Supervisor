<?php

namespace cardial;

use Illuminate\Database\Eloquent\Model;

class PerguntaFormulario extends Model
{
    protected $table = "pergunta_formulario";
    public $timestamps = false;
    protected $guarded = ['id'];
}
