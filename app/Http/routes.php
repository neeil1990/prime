<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/get-balanse-yandex', ['as' => 'getBalanseYandex', 'uses' => 'HomeController@getBalanseYandex']);

Route::get('/get-seranking-sum', function()
{

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'http://online.seranking.com/structure/clientapi/v2.php?method=login&login=work-api&pass='.md5('wcKcY2fgay').'');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
    $out = curl_exec($curl);
    curl_close($curl);
    $data_in = json_decode($out);



    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'http://online.seranking.com/structure/clientapi/v2.php?method=sites&token='.$data_in->token.'');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
    $out = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($out);

    $arrSum = array();
    foreach($data as $d){

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'http://online.seranking.com/structure/clientapi/v2.php?method=stat&siteid='.$d->id.'&token='.$data_in->token.'');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        $out = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($out);
        foreach($data[0]->keywords as $sum){
            $arrSum[$d->name][] = $sum->total_sum;
        }
    }

    $name = \DB::table('project_seos')->get();
    foreach($name as $p){
        if(isset($arrSum[trim($p->name_project)])){
            $end_sum = array_sum($arrSum[trim($p->name_project)]);
            $sum_osvoen = ceil($end_sum/8*30);
            $sum_osvoen_procent = ceil($sum_osvoen/$p->budget*100);


            $setting_payouts = \DB::table('setting_payouts')->where('id',1)->first();

            if($p->osvoeno > $p->budget){
                $budget = $p->budget;
            }else{
                $budget = $p->osvoeno;
            }

            if($p->procent_bonus == 0 and $p->count_day_fine == 0 and $p->procent_fine == 0){
                $enddate = strtotime('+' . $setting_payouts->count_day_fine . ' day', strtotime(preg_replace('~^(\d+)\/(\d+)\/(\d+)$~', '$3/$2/$1', $p->end)));
                if($sum_osvoen_procent >= $setting_payouts->procent_bonus){
                   $procent_bonus = $budget/100*$p->procent_seo;
                }elseif(strtotime("now") > $enddate and $sum_osvoen_procent < $setting_payouts->procent_fine){
                    $procent_bonus = '-' . $budget / 100 * $p->procent_seo;
                }else{
                    $procent_bonus = 0;
                }
            }else {
                $enddate = strtotime('+' . $setting_payouts->count_day_fine . ' day', strtotime(preg_replace('~^(\d+)\/(\d+)\/(\d+)$~', '$3/$2/$1', $p->end)));
                if ($sum_osvoen_procent >= $p->procent_bonus) {
                    $procent_bonus = $budget / 100 * $p->procent_seo;
                } elseif (strtotime("now") > $enddate and $sum_osvoen_procent < $p->procent_fine) {
                    $procent_bonus = '-' . $budget / 100 * $p->procent_seo;
                }else{
                    $procent_bonus = 0;
                }
            }




            \DB::table('project_seos')->where('id', $p->id)
                ->update(array(
                    'summa_zp' => $procent_bonus,
                    'osvoeno' => $sum_osvoen,
                    'osvoeno_procent' => $sum_osvoen_procent
                ));
        }
    }
    \DB::table('logs')->insert(
        array('progect' => 'seranking', 'what_is_done' => 'Обновление скрипта','who_did' => 'API seranking','created_at' => date('Y-m-d H:i:s'))
    );
});

Route::get('/get-balanse-yandex', function()
{
    $balanse_yandex = \DB::table('token_yandexes')->get();

    $arrBalanseYa = array();
    foreach($balanse_yandex as $ya){

        $params = array(
            'token'  => $ya->token_yandex,
            'method' => "AccountManagement",
            'param' => array(
                'Action' => 'Get',
                'locale' => 'ru',
                'SelectionCriteria' => array(
                    'Logins' => array($ya->login)
                ),
            )
        );

        $getBalanse = json_encode($params);

        $HEADER = array(
            'Accept-Language: ru',
            'Content-Type: application/json; charset=utf-8'
        );

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://api.direct.yandex.ru/live/v4/json/');
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl,CURLOPT_HTTPHEADER, $HEADER);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $getBalanse);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        curl_close($curl);

        $ac_ya = json_decode($result);


        if(empty($ac_ya->data->Accounts[0]->Amount)){
            \DB::table('project_contexts')
                ->where('id', $ya->id_company)
                ->update(array(
                    'ost_bslsnse_ya' => 0
                ));
        }else{
            \DB::table('project_contexts')
                ->where('id', $ya->id_company)
                ->update(array(
                    'ost_bslsnse_ya' => $ac_ya->data->Accounts[0]->Amount
                ));
        }

    }
    \DB::table('logs')->insert(
        array('progect' => 'yandex', 'what_is_done' => 'Обновление скрипта direct.yandex','who_did' => 'API direct.yandex','created_at' => date('Y-m-d H:i:s'))
    );
});

Route::auth();

Route::get('/', ['as' => 'index', 'uses' => 'HomeController@index']);





//Архив
Route::get('/archive-page-project/{name}', ['as' => 'archivePageProject', 'uses' => 'HomeController@archivePageProject']);

Route::get('/personal', ['as' => 'personal', 'uses' => 'HomeController@personal']);

Route::post('/update-token-yandex-form', ['as' => 'updateTokenYandexForm', 'uses' => 'HomeController@updateTokenYandexForm']);


Route::get('/setting-field-seo', ['as' => '/settingFieldSeo', 'uses' => 'HomeController@settingFieldSeo']);
Route::get('/setting-field-service-and-password', ['as' => 'settingFieldServiceAndPassword', 'uses' => 'HomeController@settingFieldServiceAndPassword']);
Route::get('/setting-field-context', ['as' => '/settingFieldContext', 'uses' => 'HomeController@settingFieldContext']);
Route::get('/setting_field_pass_seo', ['as' => 'settingFieldPassSeo', 'uses' => 'HomeController@settingFieldPassSeo']);
Route::get('/setting_field_pass_dev', ['as' => 'settingFieldPassDev', 'uses' => 'HomeController@settingFieldPassDev']);
Route::get('/setting_field_pass_context', ['as' => 'settingFieldPassContext', 'uses' => 'HomeController@settingFieldPassContext']);

Route::post('/update-setting-field', ['as' => 'updateSettingField', 'uses' => 'HomeController@updateSettingField']);


Route::get('/view-seo-and-context-project/{id}', ['as' => 'viewSeoAndContextProject', 'uses' => 'HomeController@viewSeoAndContextProject']);


Route::post('/show-procent-group', ['as' => 'showProcentGroup', 'uses' => 'HomeController@showProcentGroup']);
Route::post('/show-procent-users', ['as' => 'showProcentUsers', 'uses' => 'HomeController@showProcentUsers']);


Route::post('/show-level-group', ['as' => 'showLevelGroup', 'uses' => 'HomeController@showLevelGroup']);




Route::post('/update-group-positions', ['as' => 'updateGroupPositions', 'uses' => 'HomeController@updateGroupPositions']);
Route::post('/update-personal-positions', ['as' => 'updatePersonalPositions', 'uses' => 'HomeController@updatePersonalPositions']);
Route::post('/update-pass-seo-positions', ['as' => 'updatePassSeoPositions', 'uses' => 'HomeController@updatePassSeoPositions']);
Route::post('/update-pass-dev-positions', ['as' => 'updatePassDevPositions', 'uses' => 'HomeController@updatePassDevPositions']);
Route::post('/update-pass-context-positions', ['as' => 'updatePassContextPositions', 'uses' => 'HomeController@updatePassContextPositions']);
Route::post('/update-project-seo-positions', ['as' => 'UpdateProjectSeoPosition', 'uses' => 'HomeController@UpdateProjectSeoPosition']);
Route::post('/update-project-context-positions', ['as' => 'updateProjectContextPositions', 'uses' => 'HomeController@updateProjectContextPositions']);

Route::get('/personal/create', ['as' => 'createPersonal', 'uses' => 'HomeController@createPersonalForm']);
Route::post('/create-personal', ['as' => 'create', 'uses' => 'HomeController@create']);
Route::post('/update-personal', ['as' => 'update', 'uses' => 'HomeController@update']);

Route::post('/delite', ['as' => 'delite', 'uses' => 'HomeController@delite']);
Route::get('/personal/{id}/edit', ['as' => 'edit', 'uses' => 'HomeController@edit']);



Route::get('/pass-seo', ['as' => 'pass_context', 'uses' => 'HomeController@passSEO']);
Route::get('/pass-seo/create', ['as' => 'passSeoCreatForm', 'uses' => 'HomeController@passSeoCreatForm']);

Route::post('/create-pass-seo', ['as' => 'createPassContext', 'uses' => 'HomeController@createPassSeo']);
Route::post('/delite-pass-seo', ['as' => 'delitePassContext', 'uses' => 'HomeController@delitePassSeo']);
Route::get('/pass-seo/{id}/edit', ['as' => 'editPassContext', 'uses' => 'HomeController@editPassSeo']);
Route::post('/update-create-pass-seo', ['as' => 'updatePassContext', 'uses' => 'HomeController@updatePassSeo']);


//таблица группы
Route::get('/groups/create', ['as' => 'createGroupForm', 'uses' => 'HomeController@createGroupForm']);
Route::post('/create-groups', ['as' => 'createGroups', 'uses' => 'HomeController@createGroups']);
Route::post('/update-groups', ['as' => 'updateGroups', 'uses' => 'HomeController@updateGroups']);
Route::get('/groups/{id}/edit', ['as' => 'editGroupForm', 'uses' => 'HomeController@editGroupForm']);
Route::post('/delite-group', ['as' => 'deliteGroup', 'uses' => 'HomeController@deliteGroup']);

//пароли контекст
Route::get('/pass-context', ['as' => 'pass_context', 'uses' => 'HomeController@passContext']);
Route::get('/pass-context/create', ['as' => 'passContextCreatForm', 'uses' => 'HomeController@passContextCreatsForm']);

Route::post('/create-pass-context', ['as' => 'createPassContext', 'uses' => 'HomeController@createPassContext']);
Route::post('/delite-pass-context', ['as' => 'delitePassContext', 'uses' => 'HomeController@delitePassContext']);
Route::get('/pass-context/{id}/edit', ['as' => 'editPassContext', 'uses' => 'HomeController@editPassContext']);
Route::post('/update-create-pass-context', ['as' => 'updatePassContext', 'uses' => 'HomeController@updatePassContext']);

//пароли для разработчика
Route::get('/pass-dev', ['as' => 'passDev', 'uses' => 'HomeController@passDev']);
Route::get('/pass-dev/create', ['as' => 'passDevCreatForm', 'uses' => 'HomeController@passDevCreatForm']);
Route::post('/create-pass-dev', ['as' => 'createPassDev', 'uses' => 'HomeController@createPassDev']);
Route::post('/delite-pass-dev', ['as' => 'delitePassDev', 'uses' => 'HomeController@delitePassDev']);
Route::get('/pass-dev/{id}/edit', ['as' => 'editPassDev', 'uses' => 'HomeController@editPassDev']);
Route::post('/update-create-pass-dev', ['as' => 'updatePassDev', 'uses' => 'HomeController@updatePassDev']);


//График работы
Route::get('/work-graffik', ['as' => 'WorkGraff', 'uses' => 'HomeController@WorkGraff']);

//Проекты seo
Route::get('/project-seo', ['as' => 'projectSeo', 'uses' => 'HomeController@projectSeo']);
Route::get('/project-seo/create', ['as' => 'projectSeoCreateForm', 'uses' => 'HomeController@projectSeoCreateForm']);
Route::post('/create-project-seo', ['as' => 'createProjectSeo', 'uses' => 'HomeController@createProjectSeo']);
Route::post('/delite-project-seo', ['as' => 'deliteProjectSeo', 'uses' => 'HomeController@deliteProjectSeo']);
Route::get('/project-seo/{id}/edit', ['as' => 'editProjectSeo', 'uses' => 'HomeController@editProjectSeo']);
Route::post('/update-project-seo', ['as' => 'updateProjectSeo', 'uses' => 'HomeController@updateProjectSeo']);
//Проекты context
Route::get('/project-context', ['as' => 'projectContext', 'uses' => 'HomeController@projectContext']);
Route::get('/project-context/create', ['as' => 'projectContextCreateForm', 'uses' => 'HomeController@projectContextCreateForm']);
Route::post('/create-project-context', ['as' => 'createProjectContext', 'uses' => 'HomeController@createProjectContext']);
Route::post('/delite-project-context', ['as' => 'deliteProjectContext', 'uses' => 'HomeController@deliteProjectContext']);
Route::get('/project-context/{id}/edit', ['as' => 'editProjectContext', 'uses' => 'HomeController@editProjectContext']);
Route::post('/update-project-context', ['as' => 'updateProjectContext', 'uses' => 'HomeController@updateProjectContext']);
//Сервисы & Пароли
Route::get('/service-and-password', ['as' => 'serviceAndPassword', 'uses' => 'HomeController@serviceAndPassword']);
Route::get('/service-and-password/create', ['as' => 'serviceAndPasswordCreateForm', 'uses' => 'HomeController@serviceAndPasswordCreateForm']);
Route::post('/create-service-and-password', ['as' => 'createServiceAndPassword', 'uses' => 'HomeController@createServiceAndPassword']);
Route::post('/delite-service-and-pass', ['as' => 'deliteServiceAndPass', 'uses' => 'HomeController@deliteServiceAndPass']);
Route::get('/service-and-password/{id}/edit', ['as' => 'editServiceAndPassword', 'uses' => 'HomeController@editServiceAndPassword']);
Route::post('/update-service-and-password', ['as' => 'updateServiceAndPassword', 'uses' => 'HomeController@updateServiceAndPassword']);

//Настройка выплат
Route::get('/setting-payout', ['as' => 'settingPayout', 'uses' => 'HomeController@settingPayout']);
Route::post('/save-setting-payout', ['as' => 'saveSettingPayout', 'uses' => 'HomeController@saveSettingPayout']);

//Логи
Route::get('/logs', ['as' => 'viewLogs', 'uses' => 'Controller@viewLogs']);

//ссылки
Route::post('/create-link-user', ['as' => 'createLinkUser', 'uses' => 'HomeController@createLinkUser']);
Route::post('/delite-link-user', ['as' => 'deliteLinkUser', 'uses' => 'HomeController@deliteLinkUser']);
Route::post('/edit-add-link-user', ['as' => 'editAddLinkUser', 'uses' => 'HomeController@editAddLinkUser']);
Route::get('/edit-link-user/{id}/edit', ['as' => 'editLinkUser', 'uses' => 'HomeController@editLinkUser']);
