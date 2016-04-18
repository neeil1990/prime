<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    protected $fillable = [
        'id_user',
        'positions',
        'specialnost',
        'level',
        'oklad',
        'procent_seo',
        'procent_context',
    ];


    public function UpdateGroupsUser($data)
    {
        \DB::table('groups')->where('id', $data['id'])
            ->update(array(
                'specialnost' => $data['specialnost'],
                'level' => $data['level'],
                'oklad' => $data['oklad'],
                'procent_seo' => $data['procent_seo'],
                'procent_context' => $data['procent_context'],
            ));

    }

    public function UpdateGroupsPosition($id,$positions)
    {
        \DB::table('groups')->where('id', $id)
            ->update(array(
                'positions' => $positions
            ));

    }





}
