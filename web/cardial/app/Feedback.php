<?php

namespace cardial;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = "feedback";
    public $timestamps = false;
    protected $guarded = ['id'];
}