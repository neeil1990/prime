<?php

namespace App\Http\Controllers;

use App\Logs;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Request;


class Controller extends BaseController
{

    //логи при ридактировании
    public function redactor_project_seo_logs($create_data){

        $showData = \DB::table('project_seos')->where('id',$create_data['id'])->first();
        $showData->value_serialize = unserialize($showData->value_serialize);

        $user_now = new HomeController();
        $user_name = $user_now->user_now()->name;

        if(!isset($create_data['status'])){
            $create_data['status'] = 0;
        }
        if ($showData->status != $create_data['status']) {
            $this->add_logs('Проекты SEO : ' . $showData->name_project, 'Отправлен в архив', $user_name);
        }
        if($showData->name_project != $create_data['name_project']) {
            $this->add_logs('Проекты SEO : ' . $showData->name_project, 'Замена имени проекта на ' . $create_data['name_project'], $user_name);
        }else{$showData->name_project = $create_data['name_project'];}
        if($showData->budget != $create_data['budget']){
            $this->add_logs('Проекты SEO : '.$showData->name_project,'Изменен бюджет на '.$create_data['budget'],$user_name);
        }
        if($showData->osvoeno != $create_data['osvoeno']){
            $this->add_logs('Проекты SEO : '.$showData->name_project,'Изменен освоено на '.$create_data['osvoeno'],$user_name);
        }
        if($showData->osvoeno_procent != $create_data['osvoeno_procent']){
            $this->add_logs('Проекты SEO : '.$showData->name_project,'Изменен освоенный процент на '.$create_data['osvoeno_procent'],$user_name);
        }
        if($create_data['id_user']){

            $user_name_sp = array();
            foreach ($create_data['id_user'] as $user) {
                $user_name_sp[] = $user_now->user_get_id($user)->name;
            }
            $name = implode(",", $user_name_sp);
            $this->add_logs('Проекты SEO : '.$showData->name_project,'Назначены специалисты: '.$name,$user_name);
        }
        if($showData->id_glavn_user != $create_data['id_glavn_user']){
            $this->add_logs('Проекты SEO : '.$showData->name_project,'Главный специалист: '.$user_now->user_get_id($create_data['id_glavn_user'])->name,$user_name);
        }
        if($showData->procent_seo != $create_data['procent_seo']){
            $this->add_logs('Проекты SEO : '.$showData->name_project,'Изменен % от проекта: '.$create_data['procent_seo'],$user_name);
        }
        if($showData->summa_zp != $create_data['summa_zp']){
            $this->add_logs('Проекты SEO : '.$showData->name_project,'Измененa Сумма на з.п.: '.$create_data['summa_zp'],$user_name);
        }
        if($showData->start != $create_data['start']){
            $this->add_logs('Проекты SEO : '.$showData->name_project,'Изменен Старт: '.$create_data['start'],$user_name);
        }
        if($showData->end != $create_data['end']){
            $this->add_logs('Проекты SEO : '.$showData->name_project,'Изменен Конец: '.$create_data['end'],$user_name);
        }
        if($showData->aim != $create_data['aim']){
            $this->add_logs('Проекты SEO : '.$showData->name_project,'Изменен Цель: '.$create_data['aim'],$user_name);
        }
        if($showData->region != $create_data['region']){
            $this->add_logs('Проекты SEO : '.$showData->name_project,'Изменен Регион: '.$create_data['region'],$user_name);
        }
        if($showData->dogovor_number != $create_data['dogovor_number']){
            $this->add_logs('Проекты SEO : '.$showData->name_project,'Изменен Номер договора: '.$create_data['dogovor_number'],$user_name);
        }
        if($showData->contact_person != $create_data['contact_person']){
            $this->add_logs('Проекты SEO : '.$showData->name_project,'Изменен  Контактное лицо: '.$create_data['contact_person'],$user_name);
        }
        if($showData->phone_person != $create_data['phone_person']){
            $this->add_logs('Проекты SEO : '.$showData->name_project,'Изменен Номер телефона: '.$create_data['phone_person'],$user_name);
        }
        if($showData->e_mail != $create_data['e_mail']){
            $this->add_logs('Проекты SEO : '.$showData->name_project,'Изменен e-mail: '.$create_data['e_mail'],$user_name);
        }
        $value_serialize = unserialize($create_data['value_serialize']);
        if(count($showData->value_serialize) != count($value_serialize) and !empty($value_serialize)){
            $value = implode(",", $value_serialize);
            $this->add_logs('Проекты SEO : '.$showData->name_project,'Изменена Дополнительная информация: '.$value,$user_name);
        }

    }

    public function redactor_project_context_logs($data){

        $showData = \DB::table('project_contexts')->where('id',$data['id'])->first();
        $showData->value_serialize = unserialize($showData->value_serialize);

        $user_now = new HomeController();
        $user_name = $user_now->user_now()->name;

        if(!isset($data['status'])){
            $data['status'] = 0;
        }

        if($showData->status != $data['status']){
            $this->add_logs('Проект Контекст : '.$showData->name_project,'Отправлен в архив',$user_name);
        }
        if($showData->name_project != $data['name_project']){
            $this->add_logs('Проект Контекст : '.$showData->name_project,'Изменен Имя проекта: '.$data['name_project'],$user_name);
        }else{$showData->name_project = $data['name_project'];}
        if($showData->ya_direct != $data['ya_direct']){
            $this->add_logs('Проект Контекст : '.$showData->name_project,'Изменен Я.Директ: '.$data['ya_direct'],$user_name);
        }
        if($showData->go_advords != $data['go_advords']){
            $this->add_logs('Проект Контекст : '.$showData->name_project,'Изменен Г.Адвордс: '.$data['go_advords'],$user_name);
        }
        if($showData->ost_bslsnse_ya != $data['ost_bslsnse_ya']){
            $this->add_logs('Проект Контекст : '.$showData->name_project,'Изменен Остаток на балансе Яндекса: '.$data['ost_bslsnse_ya'],$user_name);
        }
        if($showData->ost_bslsnse_go != $data['ost_bslsnse_go']){
            $this->add_logs('Проект Контекст : '.$showData->name_project,'Изменен Остаток на балансе Гугл: '.$data['ost_bslsnse_go'],$user_name);
        }
        if($showData->id_glavn_user != $data['id_glavn_user']){
            $this->add_logs('Проект Контекст : '.$showData->name_project,'Главный специалист: '.$user_now->user_get_id($data['id_glavn_user'])->name,$user_name);
        }
        if($data['id_user']){

            $user_name_sp = array();
            foreach ($data['id_user'] as $user) {
                $user_name_sp[] = $user_now->user_get_id($user)->name;
            }
            $name = implode(",", $user_name_sp);
            $this->add_logs('Проект Контекст : '.$showData->name_project,'Назначены специалисты: '.$name,$user_name);
        }
        if($showData->procent_seo != $data['procent_seo']){
            $this->add_logs('Проект Контекст : '.$showData->name_project,'Изменен % от проекта: '.$data['procent_seo'],$user_name);
        }
        if($showData->dogovor_number != $data['dogovor_number']){
            $this->add_logs('Проект Контекст : '.$showData->name_project,'Изменен Номер договора: '.$data['dogovor_number'],$user_name);
        }
        if($showData->contact_person != $data['contact_person']){
            $this->add_logs('Проект Контекст : '.$showData->name_project,'Изменен Контактное лицо: '.$data['contact_person'],$user_name);
        }
        if($showData->phone_person != $data['phone_person']){
            $this->add_logs('Проект Контекст : '.$showData->name_project,'Изменен Номер телефона: '.$data['phone_person'],$user_name);
        }
        if($showData->e_mail != $data['e_mail']){
            $this->add_logs('Проект Контекст : '.$showData->name_project,'Изменен e-mail: '.$data['e_mail'],$user_name);
        }
        $value_serialize = unserialize($data['value_serialize']);
        if(count($showData->value_serialize) != count($value_serialize) and !empty($value_serialize)){
            $value = implode(",", $value_serialize);
            $this->add_logs('Проекты SEO : '.$showData->name_project,'Изменена Дополнительная информация: '.$value,$user_name);
        }

    }

    public function redactor_pass_seo_logs($data){

        $p = 'Изменено поле ';

        $showData = \DB::table('pass_seos')->where('id',$data['id'])->first();
        $showData->value_serialize = unserialize($showData->value_serialize);

        $user_now = new HomeController();
        $user_name = $user_now->user_now()->name;

        if(!isset($data['status'])){
            $data['status'] = 0;
        }

        if($showData->status != $data['status']){
            $this->add_logs('Пароли SEO : '.$showData->name_project,'Отправлен в архив',$user_name);
        }
        if($showData->name_project != $data['name_project']){
            $this->add_logs('Пароли SEO : '.$showData->name_project,$p.'Имя проекта: '.$data['name_project'],$user_name);
        }else{$showData->name_project = $data['name_project'];}
        if($data['id_user']){

            $user_name_sp = array();
            foreach ($data['id_user'] as $user) {
                $user_name_sp[] = $user_now->user_get_id($user)->name;
            }
            $name = implode(",", $user_name_sp);
            $this->add_logs('Пароли SEO : '.$showData->name_project,'Назначены специалисты: '.$name,$user_name);
        }
        if($showData->id_glavn_user != $data['id_user_gl']){
            $this->add_logs('Пароли SEO : '.$showData->name_project,'Главный специалист: '.$user_now->user_get_id($data['id_user_gl'])->name,$user_name);
        }
        if($showData->admin_url != $data['admin_url']){
            $this->add_logs('Пароли SEO : '.$showData->name_project,$p.'Админка : '.$data['admin_url'],$user_name);
        }
        if($showData->admin_login != $data['admin_login']){
            $this->add_logs('Пароли SEO : '.$showData->name_project,$p.'Логин : '.$data['admin_login'],$user_name);
        }
        if($showData->admin_pass != $data['admin_pass']){
            $this->add_logs('Пароли SEO : '.$showData->name_project,$p.'Пароль : '.$data['admin_pass'],$user_name);
        }
        if($showData->ssa != $data['ssa']){
            $this->add_logs('Пароли SEO : '.$showData->name_project,$p.'SSH : '.$data['ssa'],$user_name);
        }
        if($showData->ftp != $data['ftp']){
            $this->add_logs('Пароли SEO : '.$showData->name_project,$p.'FTP : '.$data['ftp'],$user_name);
        }
        if($showData->login != $data['login']){
            $this->add_logs('Пароли SEO : '.$showData->name_project,$p.'Логин : '.$data['login'],$user_name);
        }
        if($showData->password != $data['password']){
            $this->add_logs('Пароли SEO : '.$showData->name_project,$p.'Пароль : '.$data['password'],$user_name);
        }
        $value_serialize = unserialize($data['value_serialize']);
        if(count($showData->value_serialize) != count($value_serialize) and !empty($value_serialize)){
            $value = implode(",", $value_serialize);
            $this->add_logs('Пароли SEO : '.$showData->name_project,'Изменена Дополнительная информация: '.$value,$user_name);
        }


    }

    public function redactor_pass_dev_logs($data)
    {

        $p = 'Изменено поле ';

        $showData = \DB::table('pass_devs')->where('id', $data['id'])->first();
        $showData->value_serialize = unserialize($showData->value_serialize);

        $user_now = new HomeController();
        $user_name = $user_now->user_now()->name;

        if(!isset($data['status'])){
            $data['status'] = 0;
        }

        if ($showData->status != $data['status']) {
            $this->add_logs('Пароли DEV : ' . $showData->name_project, 'Отправлен в архив', $user_name);
        }
        if ($showData->name_project != $data['name_project']) {
            $this->add_logs('Пароли DEV : ' . $showData->name_project, $p . 'Имя проекта: ' . $data['name_project'], $user_name);
        } else {
            $showData->name_project = $data['name_project'];
        }
        if ($data['id_user']) {

            $user_name_sp = array();
            foreach ($data['id_user'] as $user) {
                $user_name_sp[] = $user_now->user_get_id($user)->name;
            }
            $name = implode(",", $user_name_sp);
            $this->add_logs('Пароли DEV : ' . $showData->name_project, 'Назначены специалисты: ' . $name, $user_name);
        }
        if($showData->id_glavn_user != $data['id_user_gl']){
            $this->add_logs('Пароли DEV : '.$showData->name_project,'Главный специалист: '.$user_now->user_get_id($data['id_user_gl'])->name,$user_name);
        }
        if($showData->admin_url != $data['admin_url']){
            $this->add_logs('Пароли DEV : '.$showData->name_project,$p.'Админка : '.$data['admin_url'],$user_name);
        }
        if($showData->admin_login != $data['admin_login']){
            $this->add_logs('Пароли DEV : '.$showData->name_project,$p.'Логин : '.$data['admin_login'],$user_name);
        }
        if($showData->admin_pass != $data['admin_pass']){
            $this->add_logs('Пароли DEV : '.$showData->name_project,$p.'Пароль : '.$data['admin_pass'],$user_name);
        }
        if($showData->ssa != $data['ssa']){
            $this->add_logs('Пароли DEV : '.$showData->name_project,$p.'SSH : '.$data['ssa'],$user_name);
        }
        if($showData->ftp != $data['ftp']){
            $this->add_logs('Пароли DEV : '.$showData->name_project,$p.'FTP : '.$data['ftp'],$user_name);
        }
        if($showData->login != $data['login']){
            $this->add_logs('Пароли DEV : '.$showData->name_project,$p.'Логин : '.$data['login'],$user_name);
        }
        if($showData->password != $data['password']){
            $this->add_logs('Пароли DEV : '.$showData->name_project,$p.'Пароль : '.$data['password'],$user_name);
        }
        $value_serialize = unserialize($data['value_serialize']);
        if(count($showData->value_serialize) != count($value_serialize) and !empty($value_serialize)){
            $value = implode(",", $value_serialize);
            $this->add_logs('Пароли DEV : '.$showData->name_project,'Изменена Дополнительная информация: '.$value,$user_name);
        }

    }

    public function redactor_pass_context_logs($data)
    {

        $p = 'Изменено поле ';

        $showData = \DB::table('pass_contexts')->where('id', $data['id'])->first();
        $showData->value_serialize = unserialize($showData->value_serialize);

        $user_now = new HomeController();
        $user_name = $user_now->user_now()->name;

        if(!isset($data['status'])){
            $data['status'] = 0;
        }

        if ($showData->status != $data['status']) {
            $this->add_logs('Пароли Контекст : ' . $showData->name_project, 'Отправлен в архив', $user_name);
        }
        if ($showData->name_project != $data['name_project']) {
            $this->add_logs('Пароли Контекст : ' . $showData->name_project, $p . 'Имя проекта: ' . $data['name_project'], $user_name);
        } else {
            $showData->name_project = $data['name_project'];
        }
        if ($data['id_user']) {

            $user_name_sp = array();
            foreach ($data['id_user'] as $user) {
                $user_name_sp[] = $user_now->user_get_id($user)->name;
            }
            $name = implode(",", $user_name_sp);
            $this->add_logs('Пароли Контекст : ' . $showData->name_project, 'Назначены специалисты: ' . $name, $user_name);
        }
        if ($showData->id_glavn_user != $data['id_user_gl']) {
            $this->add_logs('Пароли Контекст : ' . $showData->name_project, 'Главный специалист: ' . $user_now->user_get_id($data['id_user_gl'])->name, $user_name);
        }

        if ($showData->loginYandex != $data['loginYandex']) {
            $this->add_logs('Пароли Контекст : ' . $showData->name_project, $p . 'Логин Яндекс : ' . $data['loginYandex'], $user_name);
        }

        if ($showData->passYandex != $data['passYandex']) {
            $this->add_logs('Пароли Контекст : ' . $showData->name_project, $p . 'Пароль Яндекс : ' . $data['	passYandex'], $user_name);
        }
        if ($showData->loginGoogle != $data['loginGoogle']) {
            $this->add_logs('Пароли Контекст : ' . $showData->name_project, $p . 'Логин Гугл : ' . $data['loginGoogle'], $user_name);
        }
        if ($showData->passGoogle != $data['passGoogle']) {
            $this->add_logs('Пароли Контекст : ' . $showData->name_project, $p . 'Пароль Гугл : ' . $data['passGoogle'], $user_name);
        }
        $value_serialize = unserialize($data['value_serialize']);
        if(count($showData->value_serialize) != count($value_serialize) and !empty($value_serialize)){
            $value = implode(",", $value_serialize);
            $this->add_logs('Пароли Контекст : '.$showData->name_project,'Изменена Дополнительная информация: '.$value,$user_name);
        }

    }

    public function redactor_service_and_password_logs($data)
    {

        $p = 'Изменено поле ';

        $showData = \DB::table('service_and_passes')->where('id', $data['id'])->first();


        $user_now = new HomeController();
        $user_name = $user_now->user_now()->name;

        if(!isset($data['status'])){
            $data['status'] = 0;
        }

        if ($showData->status != $data['status']) {
            $this->add_logs('Сервисы & Пароли : ' . $showData->name_project, 'Отправлен в архив', $user_name);
        }
        if ($showData->name_project != $data['name_project']) {
            $this->add_logs('Сервисы & Пароли : ' . $showData->name_project, $p . 'Имя проекта: ' . $data['name_project'], $user_name);
        } else {
            $showData->name_project = $data['name_project'];
        }
        if ($data['id_user']) {

            $user_name_sp = array();
            foreach ($data['id_user'] as $user) {
                $user_name_sp[] = $user_now->user_get_id($user)->name;
            }
            $name = implode(",", $user_name_sp);
            $this->add_logs('Сервисы & Пароли : ' . $showData->name_project, 'Назначены специалисты: ' . $name, $user_name);
        }
        if ($showData->login != $data['login']) {
            $this->add_logs('Сервисы & Пароли : ' . $showData->name_project, $p . 'Логин : ' . $data['login'], $user_name);
        }
        if ($showData->password != $data['password']) {
            $this->add_logs('Сервисы & Пароли : ' . $showData->name_project, $p . 'Пароль : ' . $data['password'], $user_name);
        }
        if(count($showData->dop_infa) != count($data['dop_infa'])){
            $this->add_logs('Сервисы & Пароли : '.$showData->name_project,'Изменена Дополнительная информация: '.$data['dop_infa'],$user_name);
        }
    }

    public function redactor_personal_logs($data){

        $p = 'Изменено поле ';

        $showData = \DB::table('users')->where('id', $data['id'])->first();


        $user_now = new HomeController();
        $user_name = $user_now->user_now()->name;

        if(!isset($data['status'])){
            $data['status'] = 0;
        }

        if ($showData->name != $data['name']) {
            $this->add_logs('Сотрудники : ' . $showData->name, $p . 'Сотрудник : ' . $data['name'], $user_name);
        }
        if ($showData->specialism != $data['specialism']) {
            $this->add_logs('Сотрудники : ' . $showData->name, $p . 'Специализация : ' . $data['specialism'], $user_name);
        }
        if ($showData->level != $data['level']) {
            $this->add_logs('Сотрудники : ' . $showData->name, $p . 'Уровень : ' . $data['level'], $user_name);
        }
        if ($showData->personal_specialism != $data['personal_specialism']) {
            $this->add_logs('Сотрудники : ' . $showData->name, $p . 'Специалист : ' . $data['personal_specialism'], $user_name);
        }
        if ($showData->seo_procent != $data['seo_procent']) {
            $this->add_logs('Сотрудники : ' . $showData->name, $p . 'Бонус от проекта SEO : ' . $data['seo_procent'], $user_name);
        }
        if ($showData->sum_many_first != $data['sum_many_first']) {
            $this->add_logs('Сотрудники : ' . $showData->name, $p . 'Оклад : ' . $data['sum_many_first'], $user_name);
        }
        if ($showData->contecst_procent != $data['contecst_procent']) {
            $this->add_logs('Сотрудники : ' . $showData->name, $p . '% от проекта контекста : ' . $data['contecst_procent'], $user_name);
        }
        if ($showData->email != $data['email']) {
            $this->add_logs('Сотрудники : ' . $showData->name, $p . 'E-Mail Address : ' . $data['email'], $user_name);
        }

    }


    //логи при удалении
    public function delite_personal_logs($data){
        $user_now = new HomeController();
        $user_name = $user_now->user_now()->name;
        $this->add_logs('Сотрудники' ,'Удален: '.$data , $user_name);
    }

    public function delite_logs($table,$data,$name){
        $showData = \DB::table($table)->where('id', $data)->first();
        $user_now = new HomeController();
        $user_name = $user_now->user_now()->name;
        $this->add_logs($name ,'Удален: '.$showData->name_project , $user_name);
    }
    //логи при добавлении
    public function create_logs($name,$data){
        $user_now = new HomeController();
        $user_name = $user_now->user_now()->name;
        $this->add_logs($name ,'Добавлен: '.$data , $user_name);
    }

    public function api_logs($name,$data,$user_name){
        $this->add_logs($name ,$data , $user_name);
    }




    public function add_logs($project,$what_is_done,$who_did){
        Logs::create([
            'progect' => $project,
            'what_is_done' => $what_is_done,
            'who_did' => $who_did
        ]);
    }

    public function viewLogs(Logs $logs){
       $home = new HomeController();
        if($home->admin() == 1){
            $all = $logs->all()->sortByDesc('id');
            return view('page.logs',[
                'all' => $all,
                'admin' => $home->admin()
            ]);
        }else{
            return false;
        }


    }

    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;


}
