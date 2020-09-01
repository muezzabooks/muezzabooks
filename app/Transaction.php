<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;

class Transaction extends Model
{
    use AutoNumberTrait;
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
    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => function () {
                    return date('Ymd') . 'MZB?';
                },
                'length' => 5
            ]
        ];
    }
}
