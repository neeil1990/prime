<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingPayout extends Model
{
    protected $fillable = [
        'procent_bonus',
        'count_day_fine',
        'procent_fine',
        'procent_for_fine',
        'bonus_add',
        'procent_seo',
    ];

    public function UpdateSettingPayout($data){

        \DB::table('setting_payouts')->where('id', 1)
            ->update(array(
                'procent_bonus' => trim($data['procent_bonus']),
                'count_day_fine' => trim($data['count_day_fine']),
                'procent_fine' => trim($data['procent_fine']),
                'procent_for_fine' => trim($data['procent_for_fine']),
                'bonus_add' => trim($data['bonus_add']),
                'procent_seo' => trim($data['procent_seo'])
            ));
    }


}
