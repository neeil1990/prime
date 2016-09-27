<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PassSeo extends Model
{
    protected $fillable = [
        'id_user',
        'status',
        'id_glavn_user',
        'name_project',
        'specialist',
        'ssa',
        'ftp',
        'admin_url',
        'admin_login',
        'admin_pass',
        'login',
        'password',
        'value_serialize',
    ];

    public function UpdatePassSeoUser($data){

        if(empty($data['value_serialize'])){
            $data['value_serialize'] = '';
        }else{
            $data['value_serialize'] = serialize($data['value_serialize']);
        }

        $Controller = new Http\Controllers\Controller();
        $Controller->redactor_pass_seo_logs($data);

        if(!isset($data['status'])){
            $data['status'] = 0;
        }

        \DB::table('pass_seos')->where('id', $data['id'])
            ->update(array(
                'status' => $data['status'],
                'name_project' => $data['name_project'],
                'id_glavn_user' => $data['id_user_gl'],
                'ssa' => $data['ssa'],
                'ftp' => $data['ftp'],
                'admin_url' => $data['admin_url'],
                'admin_login' => $data['admin_login'],
                'admin_pass' => $data['admin_pass'],
                'login' => $data['login'],
                'password' => $data['password'],
                'value_serialize' => $data['value_serialize']
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


    public function UpdatePassSeoPosition($id,$positions)
    {
        \DB::table('pass_seos')->where('id', $id)
            ->update(array(
                'positions' => $positions
            ));

    }

}
