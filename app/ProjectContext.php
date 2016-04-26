<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectContext extends Model
{


    protected $fillable = [
        'name_project',
        'ya_direct',
        'go_advords',
        'ost_bslsnse_ya',
        'ost_bslsnse_go',
        'id_glavn_user',
        'procent_seo',
        'value_serialize'
    ];

    public function UpdateProjectContextPosition($id,$positions){
        \DB::table('project_contexts')->where('id', $id)
            ->update(array(
                'positions' => $positions
            ));
    }

    public function UpdateProjectContextUser($data){



        \DB::table('project_contexts')->where('id', $data['id'])
            ->update(array(
                'name_project' => $data['name_project'],
                'ya_direct' => $data['ya_direct'],
                'go_advords' => $data['go_advords'],
                'ost_bslsnse_ya' => $data['ost_bslsnse_ya'],
                'ost_bslsnse_go' => $data['ost_bslsnse_go'],
                'id_glavn_user' => $data['id_glavn_user'],
                'procent_seo' => $data['procent_seo'],
                'value_serialize' => serialize($data['value_serialize'])
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
                    'id_type' => 5
                )
            );
        }
    }






}
