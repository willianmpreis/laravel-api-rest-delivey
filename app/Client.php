<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name', 'cpf', 'phone', 'birth', 'address'];

    function user() {
        return $this->belongsTo("App\User");
    }
}
