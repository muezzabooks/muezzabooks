<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    // public function category()
    // {
    //     return $this->hasMany('App\Category');
    // }

    protected $table = 'products';

    // protected $fillable = (['product_name','description','stock','price','image_name', 'image_path']);
    protected $fillable = (['product_name','description','stock','price']);
}