<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PassSeo extends Model
{
    protected $fillable = [
        'id_user',
        'name_project',
        'specialist',
        'ssa',
        'ftp',
        'login',
        'password',
    ];


    public function getUserPassSeo($id_now){

        $users = User::whereRaw('id = ? and admin = 1', [$id_now])->count();
        if($users == 1){
            $users = \DB::table('users')->join('pass_seos','users.id','=','pass_seos.id_user')->get();
        }else{
            $users = \DB::table('users')->join('pass_seos','users.id','=','pass_seos.id_user')->whereRaw('users.id = ? and users.admin = 0', [$id_now])->get();
        }
        return $users;
    }

    public function UpdatePassSeoUser($data){
        \DB::table('pass_seos')->where('id', $data['id'])
            ->update(array(
                'name_project' => $data['name_project'],
                'id_user' => $data['id_user'],
                'ssa' => $data['ssa'],
                'ftp' => $data['ftp'],
                'login' => $data['login'],
                'password' => $data['password']
            ));
    }

}
