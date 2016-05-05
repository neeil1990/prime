<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingField extends Model
{

    protected $fillable = [
        'name',
        'field',
        'value',
        'table_value'
    ];
}
