<?php

namespace cardial;

use Illuminate\Database\Eloquent\Model;

class Resposta extends Model {

    protected $table = "resposta";
    public $timestamps = false;
    protected $guarded = ['id'];

    public function Visita() {
        return $this->belongsTo('cardial\Visita');
    }

    public function Pergunta() {
        return $this->belongsTo('cardial\Pergunta');
    }

}
