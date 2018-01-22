<?php

namespace App;

use App\Http\Controllers\HomeController;
use Illuminate\Database\Eloquent\Model;

class ProjectSeo extends Model
{
    protected $fillable = [
        'status',
        'name_project',
        'budget',
        'osvoeno',
        'osvoeno_procent',
        'id_glavn_user',
        'procent_seo',
        'summa_zp',
        'startpoint',
        'lp',
        'start',
        'end',
        'aim',
        'region',
        'dogovor_number',
        'contact_person',
        'phone_person',
        'e_mail',
        'value_serialize',
    ];




    public function UpdateProjectSeoPosition($id,$positions){
        \DB::table('project_seos')->where('id', $id)
            ->update(array(
                'positions' => $positions
            ));
    }

    public function UpdateProjectSeoUser($data){


        if(empty($data['value_serialize'])){
            $data['value_serialize'] = '';
        }else{
            $data['value_serialize'] = serialize($data['value_serialize']);
        }

        $Controller = new Http\Controllers\Controller();
        $Controller->redactor_project_seo_logs($data);

        if(!isset($data['status'])){
            $data['status'] = 0;
        }


        \DB::table('project_seos')->where('id', $data['id'])
            ->update(array(
                'status' => $data['status'],
                'procent_bonus' => trim($data['procent_bonus']),
                'count_day_fine' => trim($data['count_day_fine']),
                'procent_fine' => trim($data['procent_fine']),
                'procent_for_fine' => trim($data['procent_for_fine']),
                'bonus_add' => trim($data['bonus_add']),
                'bonus_enable' => trim($data['bonus_enable']),
                'name_project' => $data['name_project'],
                'budget' => $data['budget'],
                'osvoeno' => $data['osvoeno'],
                'osvoeno_procent' => $data['osvoeno_procent'],
                'id_glavn_user' => $data['id_glavn_user'],
                'procent_seo' => $data['procent_seo'],
                'summa_zp' => $data['summa_zp'],
                'startpoint' => $data['startpoint'],
                'lp' => $data['lp'],
                'start' => $data['start'],
                'end' => $data['end'],
                'aim' => $data['aim'],
                'region' => $data['region'],
                'dogovor_number' => $data['dogovor_number'],
                'contact_person' => $data['contact_person'],
                'phone_person' => $data['phone_person'],
                'e_mail' => $data['e_mail'],
                'value_serialize' => $data['value_serialize']
            ));

        $create_data = $data;

        foreach($data['id_sort'] as $data){
            \DB::table('sorts')->whereRaw('id = ?', [$data])->delete();
        }

        $idAr = array();
        foreach($create_data['id_user'] as $data) {

        $idAr[] = \DB::table('sorts')->insertGetId(
                array(
                    'id_user' => $data,
                    'id_table' => $create_data['id'],
                    'id_type' => 4
                )
            );
        }




    }



}
