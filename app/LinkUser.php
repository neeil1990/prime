<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinkUser extends Model
{
    protected $fillable = [
        'name',
        'link',
        'position'
    ];
}
