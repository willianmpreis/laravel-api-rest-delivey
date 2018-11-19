<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    protected $fillable = ['shopping_id', 'product_id', 'quantity', 'unitary', 'amount'];
}
