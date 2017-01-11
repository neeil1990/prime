<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $fillable = [
        'progect',
        'what_is_done',
        'who_did'
    ];
}
