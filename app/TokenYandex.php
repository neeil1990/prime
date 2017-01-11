<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TokenYandex extends Model
{
    protected $fillable = [
        'id_company',
        'login',
        'token_yandex',
    ];

}
