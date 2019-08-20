<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collector extends Model
{
    //
    protected $guarded = [];

    public function loan(){
        return $this->hasMany('App\Loan','collector_id');
    }
}
