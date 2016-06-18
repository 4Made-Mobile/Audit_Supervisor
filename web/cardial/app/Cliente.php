<?php

namespace cardial;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model {

    protected $table = "cliente";
    public $timestamps = false;
    protected $guarded = ['id'];

    public function VisitaBase() {
        return $this->hasMany('cardial\VisitaBase');
    }

    public function ClienteVendedor() {
        return $this->hasOne('cardial\ClienteVendedor');
    }

}
