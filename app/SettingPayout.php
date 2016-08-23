<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingPayout extends Model
{
    protected $fillable = [
        'procent_bonus',
        'count_day_fine',
        'procent_fine',
    ];

    public function UpdateSettingPayout($data){

        \DB::table('setting_payouts')->where('id', 1)
            ->update(array(
                'procent_bonus' => trim($data['procent_bonus']),
                'count_day_fine' => trim($data['count_day_fine']),
                'procent_fine' => trim($data['procent_fine'])
            ));
    }


}
