<?php

namespace cardial;

use Illuminate\Database\Eloquent\Model;

class ClienteVendedor extends Model {

    protected $table = "cliente_vendedor";
    public $timestamps = false;

    public function Cliente() {
        return $this->belongsTo('cardial\cliente');
    }

    public function Vendedor() {
        return $this->belongsTo('cardial\vendedor');
    }

}
