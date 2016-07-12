<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceAndPass extends Model
{

    protected $fillable = [
        'status',
        'name_project',
        'login',
        'password',
        'dop_infa'
    ];


    public function UpdateServiceAndPass($data){

        if(!isset($data['status'])){
            $data['status'] = 0;
        }

        \DB::table('service_and_passes')->where('id', $data['id'])
            ->update(array(
                'name_project' => $data['name_project'],
                'status' => $data['status'],
                'login' => $data['login'],
                'password' => $data['password'],
                'dop_infa' => $data['dop_infa']
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
                    'id_type' => 6
                )
            );
        }
    }

}
