<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model{
    protected $table = 'clients';

    protected $fillable = [
        'name', 'email', 'phone','image','order'
    ];
}

