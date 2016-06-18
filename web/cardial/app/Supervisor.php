<?php

namespace cardial;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model {

    protected $table = "supervisor";
    public $timestamps = false;
    protected $guarded = ['id'];

}
