<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sort extends Model
{
    protected $fillable = [
        'id_user',
        'id_table',
        'id_type',
        'id_glavn_user',
    ];

}
