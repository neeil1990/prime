<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $fillable = [
        'summa',
        'project',
        'type',
        'spec',
        'data',
    ];
}
