<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $guarded = [];

    public function loan(){
        return $this->belongsTo('App\Loan');
    }
}
