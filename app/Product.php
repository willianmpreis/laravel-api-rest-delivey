<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    function category() {
        return $this->belongsTo("App\Category");
    }
}
