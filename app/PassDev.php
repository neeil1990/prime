<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PassDev extends Model
{

    protected $fillable = [
        'id_glavn_user',
        'name_project',
        'specialist',
        'admin_url',
        'admin_login',
        'admin_pass',
        'ssa',
        'ftp',
        'login',
        'password',
    ];


    public function UpdatePassDevUser($data){

        \DB::table('pass_devs')->where('id', $data['id'])
            ->update(array(
                'name_project' => $data['name_project'],
                'id_glavn_user' => $data['id_user_gl'],
                'admin_url' => $data['admin_url'],
                'admin_login' => $data['admin_login'],
                'admin_pass' => $data['admin_pass'],
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
                    'id_type' => 3//PassDEV
                )
            );
        }


    }


    public function UpdatePassDevPosition($id,$positions){
        \DB::table('pass_devs')->where('id', $id)
            ->update(array(
                'positions' => $positions
            ));
    }



}
