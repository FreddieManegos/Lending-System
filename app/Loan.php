<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    //
    protected $guarded = [];

    public function collector(){
        return $this->belongsTo('App\Collector');
    }

    public function customer(){
        return $this->belongsTo('App\Customer');
    }

    public function payment(){
        return $this->hasMany('App\Payment','loan_id');
    }
    public function path(){
    }
}
