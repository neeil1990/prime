<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'specialism',
        'level',
        'personal_specialism',
        'seo_procent',
        'sum_many_first',
        'contecst_procent',
        'sum_many_last',
        'itog',
        'admin',
        'visibal',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function getUser($id){

        $users = User::whereRaw('id = ? and admin = 1', [$id])->count();
        if($users == 1){
            $users = User::all();
            return $users;
        }else{
            $users = User::whereRaw('id = ? and admin = 0', [$id])->get();
            return $users;
        }
    }

    public function UpdateUser($data){
        User::where('id', $data['id'])
            ->update(array(
                'name' => $data['name'],
                'specialism' => $data['specialism'],
                'level' => $data['level'],
                'personal_specialism' => $data['personal_specialism'],
                'seo_procent' => $data['seo_procent'],
                'sum_many_first' => $data['sum_many_first'],
                'contecst_procent' => $data['contecst_procent'],
                'sum_many_last' => $data['sum_many_last'],
                'itog' => $data['itog'],
            ));
    }






}
