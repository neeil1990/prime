<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingSeranking extends Model
{
    protected $fillable = [
        "date_from"
    ];

    public function UpdateSettingSeranking($data){

        \DB::table('setting_serankings')->where('id', 1)
            ->update(array(
                'date_from' => trim($data['date_from']),
            ));
    }
}
