<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingPayoutContext extends Model
{
    protected $fillable = [
        'procent_seo',
    ];

    public function UpdateSettingPayout($data){

        \DB::table('setting_payout_contexts')->where('id', 1)
            ->update(array(
                'procent_seo' => trim($data['procent_seo'])
            ));
    }


}
