<?php

namespace cardial;

use Illuminate\Database\Eloquent\Model;

class RespostaFeedback extends Model {

    protected $table = "resposta_feedback";
    public $timestamps = false;
    protected $guarded = ['id'];
    
}
