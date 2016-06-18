<?php

namespace cardial;

use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model {

    protected $table = "vendedor";
    public $timestamps = false;
    protected $guarded = ['id'];

    public function supervisor() {
        return $this->belongsTo('cardial\Supervisor');
    }

}
