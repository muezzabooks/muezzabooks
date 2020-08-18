<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function detailTransaction()
    {
        return $this->hasMany('App\DetailTransaction');
    }

    public function address()
    {
        return $this->hasOne('App\Address');
    }
}
