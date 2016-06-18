<?php

namespace cardial;

use Illuminate\Database\Eloquent\Model;

class VisitaBase extends Model {

    protected $table = "visita_base";
    public $timestamps = false;
    protected $guarded = ['id'];

    public function visita() {
        return $this->hasMany('cardial\visita', 'id', 'visita_id');
    }

    public function cliente() {
        return $this->belongsTo('cardial\cliente');
    }

    public function supervisor() {
        return $this->belongsTo('cardial\supervisor', 'id');
    }

    public function pesquisa() {
        return $this->hasMany('cardial\pesquisa');
    }

    public function vendedor() {
        return $this->belongsTo('cardial\vendedor', 'id');
    }

}
