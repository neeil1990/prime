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
        'status',
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





    public function UpdateUser($data){



        if(!empty($data['password'])){

            $message = 'Личный кабинет: http://work.prime-ltd.su '.' Логин: '.$data['email'].' '.'Пароль: '.$data['password'];
            mail($data['email'], 'Личный кабинет PRIME', $message);

            User::where('id', $data['id'])
                ->update(array(
                    'password' => bcrypt($data['password']),
                ));

        }

        if(!isset($data['status'])){
            $data['status'] = 0;
        }

        User::where('id', $data['id'])
            ->update(array(
                'status' => $data['status'],
                'name' => $data['name'],
                'admin' => $data['admin'],
                'specialism' => $data['specialism'],
                'level' => $data['level'],
                'personal_specialism' => $data['personal_specialism'],
                'seo_procent' => $data['seo_procent'],
                'sum_many_first' => $data['sum_many_first'],
                'contecst_procent' => $data['contecst_procent'],
                'sum_many_last' => $data['sum_many_last'],
                'email' => $data['email'],
            ));
    }


    public function UpdateUserPosition($id,$positions)
    {
        \DB::table('users')->where('id', $id)
            ->update(array(
                'positions' => $positions
            ));

    }






}
