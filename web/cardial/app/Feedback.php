<?php

namespace cardial;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = "formulario";
    public $timestamps = false;
    protected $guarded = ['id'];
}