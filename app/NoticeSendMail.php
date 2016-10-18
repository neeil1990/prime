<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoticeSendMail extends Model
{
    protected $fillable = [
        'mail',
        'status',
    ];
}
