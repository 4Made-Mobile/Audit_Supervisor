<?php

namespace cardial;

use Illuminate\Database\Eloquent\Model;

class Pergunta extends Model {

    protected $table = "pergunta";
    public $timestamps = false;
    protected $guarded = ['id'];

    public function Resposta() {
        return $this->hasMany('cardial\Resposta');
    }

}
