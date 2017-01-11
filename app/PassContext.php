<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PassContext extends Model
{
    protected $fillable = [
        'id_user',
        'status',
        'name_project',
        'id_glavn_user',
        'specialist',
        'loginYandex',
        'passYandex',
        'loginGoogle',
        'passGoogle',
        'value_serialize',
    ];


    public function getUserPassContext($id_now){

        $users = User::whereRaw('id = ? and admin = 1', [$id_now])->count();
        if($users == 1){
            $users = \DB::table('users')->join('pass_contexts','users.id','=','pass_contexts.id_user')->get();
        }else{
            $users = \DB::table('users')->join('pass_contexts','users.id','=','pass_contexts.id_user')->whereRaw('users.id = ? and users.admin = 0', [$id_now])->get();
        }
        return $users;
    }

    public function UpdatePassContextUser($data){

        if(empty($data['value_serialize'])){
            $data['value_serialize'] = '';
        }else{
            $data['value_serialize'] = serialize($data['value_serialize']);
        }

        $Controller = new Http\Controllers\Controller();
        $Controller->redactor_pass_context_logs($data);

        if(!isset($data['status'])){
            $data['status'] = 0;
        }

        \DB::table('pass_contexts')->where('id', $data['id'])
            ->update(array(
                'name_project' => $data['name_project'],
                'status' => $data['status'],
                'id_glavn_user' => $data['id_user_gl'],
                'loginYandex' => $data['loginYandex'],
                'passYandex' => $data['passYandex'],
                'loginGoogle' => $data['loginGoogle'],
                'passGoogle' => $data['passGoogle'],
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
                    'id_type' => 2
                )
            );
        }
    }


    public function UpdatePassContexPosition($id,$positions){
        \DB::table('pass_contexts')->where('id', $id)
            ->update(array(
                'positions' => $positions
            ));
    }
}
