<?php

namespace cardial;

use Illuminate\Database\Eloquent\Model;

class Visita extends Model {

    protected $table = "visita";
    public $timestamps = false;
    protected $guarded = ['id'];

    public function Visita() {
        return $this->belongsTo('cardial\VisitaBase');
    }

    public function Reposta() {
        return $this->hasMany('cardial\Resposta');
    }

}
