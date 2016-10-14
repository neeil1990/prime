<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoogleApi extends Model
{
    protected $fillable = [
        'google_project_id',
        'google_id_client',
        'sum',
    ];
}
