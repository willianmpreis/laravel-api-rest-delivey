<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shopping extends Model
{
    protected $fillable = ['client_id', 'date', 'canceled'];

    function products() {
        return $this->belongsToMany("App\Product", "shopping_carts")
            ->withPivot(['quantity', 'unitary', 'amount', 'canceled']);
    }
}
