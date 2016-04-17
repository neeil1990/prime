<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PassSeo extends Model
{
    protected $fillable = [
        'id_user',
        'id_glavn_user',
        'name_project',
        'specialist',
        'ssa',
        'ftp',
        'login',
        'password',
    ];

    public function UpdatePassSeoUser($data){

        \DB::table('pass_seos')->where('id', $data['id'])
            ->update(array(
                'name_project' => $data['name_project'],
                'id_glavn_user' => $data['id_user_gl'],
                'ssa' => $data['ssa'],
                'ftp' => $data['ftp'],
                'login' => $data['login'],
                'password' => $data['password']
            ));

        $create_data = $data;

        foreach($data['id_sort'] as $data){
            \DB::table('sorts')->whereRaw('id = ?', [$data])->delete();
        }

        foreach($create_data['id_user'] as $data) {

            \DB::table('sorts')->insert(
                array(
                    'id_user' => $data,
                    'id_table' => $create_data['id'],
                    'id_type' => 1
                )
            );
        }


    }

}
