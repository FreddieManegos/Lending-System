<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $guarded = [];

    public function loan(){
        return $this->hasMany('App\Loan','customer_id');
    }
}
