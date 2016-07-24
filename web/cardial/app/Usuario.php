<?php

namespace cardial;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model {

    protected $table = "usuario";
    public $timestamps = false;
    protected $guarded = ['id'];

    public function Supervisor() {
        return $this->hasOne('cardial\Supervisor', 'id', 'id');
    }

}
