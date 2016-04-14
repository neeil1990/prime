<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    protected $fillable = [
        'id_user',
        'specialnost',
        'level',
        'oklad',
        'procent_seo',
        'procent_context',
    ];


    public function getUserGroups($id_now){

        $users = User::whereRaw('id = ? and admin = 1', [$id_now])->count();
        if($users == 1){
            $users = \DB::table('users')->join('groups','users.id','=','groups.id_user')->get();
        }else{
            $users = \DB::table('users')->join('groups','users.id','=','groups.id_user')->whereRaw('users.id = ? and users.admin = 0', [$id_now])->get();
        }
        return $users;
    }

    public function UpdateGroupsUser($data){
        \DB::table('groups')->where('id', $data['id'])
            ->update(array(
                'id_user' => $data['id_user'],
                'specialnost' => $data['specialnost'],
                'level' => $data['level'],
                'oklad' => $data['oklad'],
                'procent_seo' => $data['procent_seo'],
                'procent_context' => $data['procent_context']
            ));
    }

}
