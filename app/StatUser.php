<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatUser extends Model
{
    protected $fillable = [
        'id_user',
        'id_project',
        'osvoeno_procent',
        'date_day'
    ];
}
