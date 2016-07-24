<?php

namespace cardial;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model {

    protected $table = "supervisor";
    public $timestamps = false;
    protected $guarded = ['id'];

    public function Usuario() {
        return $this->hasOne('cardial\Usuario', 'id', 'id');
    }

}
