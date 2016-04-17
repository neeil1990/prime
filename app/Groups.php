<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    protected $fillable = [
        'id_user',
        'specialnost',
        'level',
        'oklad',
        'procent_seo',
        'procent_context',
    ];





}
