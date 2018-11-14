<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'stock', 'category_id'];

    function category() {
        return $this->belongsTo("App\Category");
    }
}
