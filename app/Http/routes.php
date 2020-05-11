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
Route::post('/get-ajax-stat', ['as' => 'getAjaxStat', 'uses' => 'HomeController@getAjaxStat']);
Route::get('/stat', function()
{
    $arMaxBudjet = array();
    $progect_seo = \DB::table('project_seos')->where('status','1')->get();
    $progect_context = \DB::table('project_contexts')
        ->where('status','1')
        ->where('our_project','0')
        ->get();

    $arUserSeo = array();
    $users = \App\User::all();
    foreach($users as $u){
        $progect_spec_seo = \DB::table('project_seos')
            ->where('status','1')
            ->where('id_glavn_user',$u->id)
            ->get();
        foreach($progect_spec_seo as $s){

            $arUserSeo[$u->name]['budjet'][] = $s->budget;
            $arUserSeo[$u->name]['osvoeno'][] = $s->osvoeno;
            $arUserSeo[$u->name]['count_project'][] = $s->id;
            if($s->our_project == 1){
                $arUserSeo[$u->name]['count_project_our'][] = $s->id;
            }else{
                $arUserSeo[$u->name]['count_project_client'][] = $s->id;
            }
        }

        $progect_spec_context = \DB::table('project_contexts')
            ->where('status','1')
            ->where('id_glavn_user',$u->id)
            ->get();

        foreach($progect_spec_context as $key => $c){

            if (!is_numeric($c->ya_direct))
                $c->ya_direct = 0;

            if(!is_numeric($c->go_advords))
                $c->go_advords = 0;

            $arUserSeo[$u->name]['context_ya_direct_go_advords'][] = $c->ya_direct + $c->go_advords;
            if($c->ya_direct != 0 and !empty($c->ya_direct)) {
                $arUserSeo[$u->name]['context_ya_direct_count'][] = $c->ya_direct;
            }else{
                $arUserSeo[$u->name]['context_ya_direct_count'][] = 0;
            }
            if($c->go_advords != 0 and !empty($c->go_advords)){
                $arUserSeo[$u->name]['context_go_advords_count'][] = $c->go_advords;
            }else{
                $arUserSeo[$u->name]['context_go_advords_count'][] = 0;
            }

        }

        if(!empty($progect_spec_context)) {
            $arUserSeo[$u->name]['context_ya_direct_go_advords'] = array_sum($arUserSeo[$u->name]['context_ya_direct_go_advords']);
            $arUserSeo[$u->name]['context_ya_direct_count'] = count($arUserSeo[$u->name]['context_ya_direct_count']);
            $arUserSeo[$u->name]['context_go_advords_count'] = count($arUserSeo[$u->name]['context_go_advords_count']);
        }

        if(!empty($progect_spec_seo)) {
            $arUserSeo[$u->name]['budjet'] = array_sum($arUserSeo[$u->name]['budjet']);
            $arUserSeo[$u->name]['osvoeno'] = array_sum($arUserSeo[$u->name]['osvoeno']);
            if(isset($arUserSeo[$u->name]['count_project']))
            $arUserSeo[$u->name]['count_project'] = count($arUserSeo[$u->name]['count_project']);
            if(isset($arUserSeo[$u->name]['count_project_our']))
            $arUserSeo[$u->name]['count_project_our'] = count($arUserSeo[$u->name]['count_project_our']);
            if(isset($arUserSeo[$u->name]['count_project_client']))
            $arUserSeo[$u->name]['count_project_client'] = count($arUserSeo[$u->name]['count_project_client']);
        }

    }

    $stats_user = \DB::table('stats')
        ->where('project','all')
        ->where('type','user')
        ->where('spec','all')
        ->where('data',date('Y-m-d'))
        ->first();

    if($stats_user){
        \DB::table('stats')->where('id', $stats_user->id)
            ->update( array(
                'summa' => serialize($arUserSeo),
                'project' => 'all',
                'type' => 'user',
                'spec' => 'all',
                'data' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s')
            ));
    }else {
        \DB::table('stats')->insert(
            array(
                'summa' => serialize($arUserSeo),
                'project' => 'all',
                'type' => 'user',
                'spec' => 'all',
                'data' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s')
            )
        );
    }


    foreach($progect_context as $c){
        if($c->ya_direct != 0 and !empty($c->ya_direct))
            $arMaxBudjet['context']['ya_direct'][] = $c->ya_direct;
        if($c->go_advords != 0 and !empty($c->go_advords))
            $arMaxBudjet['context']['go_advords'][] = $c->go_advords;
    }

    $stats_context = \DB::table('stats')
        ->where('project','context')
        ->where('type','context_ya_go')
        ->where('spec','all')
        ->where('data',date('Y-m-d'))
        ->first();

    if($stats_context){
        \DB::table('stats')->where('id', $stats_context->id)
            ->update( array(
                'summa' => array_sum(array_merge($arMaxBudjet['context']['ya_direct'], $arMaxBudjet['context']['go_advords'])),
                'project' => 'context',
                'type' => 'context_ya_go',
                'spec' => 'all',
                'data' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s')
            ));
    }else {
        \DB::table('stats')->insert(
            array(
                'summa' => array_sum(array_merge($arMaxBudjet['context']['ya_direct'], $arMaxBudjet['context']['go_advords'])),
                'project' => 'context',
                'type' => 'context_ya_go',
                'spec' => 'all',
                'data' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s')
            )
        );
    }


    foreach($progect_seo as $s){
        if($s->osvoeno > $s->budget){
            $arMaxBudjet['seo_osvoeno'][] = $s->budget;
        }else {
            $arMaxBudjet['seo_osvoeno'][] = $s->osvoeno;
        }
    }

    $stats_seo = \DB::table('stats')
        ->where('project','seo')
        ->where('type','osvoeno')
        ->where('spec','all')
        ->where('data',date('Y-m-d'))
        ->first();

    if($stats_seo){
        \DB::table('stats')->where('id', $stats_seo->id)
            ->update( array(
                'summa' => array_sum($arMaxBudjet['seo_osvoeno']),
                'project' => 'seo',
                'type' => 'osvoeno',
                'spec' => 'all',
                'data' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s')
            ));
    }else {
        \DB::table('stats')->insert(
            array(
                'summa' => array_sum($arMaxBudjet['seo_osvoeno']),
                'project' => 'seo',
                'type' => 'osvoeno',
                'spec' => 'all',
                'data' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s')
            )
        );
    }

    //Statistic for users home page
    $progect_seo_user_all = \DB::table('project_seos')->where('status', '1')->get();
    $stat_users_date = \DB::table('stat_users')->where('date_day',date('Y-m-d'))->first();
    if(empty($stat_users_date)) {
        foreach ($progect_seo_user_all as $p) {
            \DB::table('stat_users')->insert(
                array(
                    'id_user' => $p->id_glavn_user,
                    'id_project' => $p->id,
                    'osvoeno_procent' => $p->osvoeno_procent,
                    'date_day' => date('Y-m-d'),
                    'created_at' => date('Y-m-d H:i:s')
                )
            );
        }
    }

});


Route::get('/send-notice-client/{count_day}/days/{name_project}/name-project', function($count_day,$name_project)
{
    set_time_limit(0);

    if($count_day == 'month'){
        $back_month = date('m')-1;
        if($back_month == 1){
            $back_month = 12;
        }else{
            $back_month = $back_month;
        }
        $count_day = cal_days_in_month(CAL_GREGORIAN, $back_month, date('Y'));
    }


    $home = new \App\Http\Controllers\HomeController();


    $google_api = \App\GoogleApi::all();
    $yandex_api = \App\TokenYandex::all();

    $dataApi = array();


   foreach($google_api as $key => $g){
      // dd($g);
     $context_google = \App\ProjectContext::find($g->google_project_id);
       if(isset($context_google) and $context_google->status == 1){
           $home = new \App\Http\Controllers\HomeController();
           $sum_accaunt = \App\Http\Controllers\AdWordsController::main($g->google_id_client,"ALL_TIME");
           $click_accaunt = \App\Http\Controllers\AdWordsController::main($g->google_id_client,$count_day);

           if($click_accaunt['clicks'] == 0){
               $clicks_price_google = 0;
           }else{
               $clicks_price_google = floor($click_accaunt['cost']/$click_accaunt['clicks']);
           }



           $dataApi[$context_google->name_project]['name_progect_google'] = $context_google->name_project;
           $dataApi[$context_google->name_project]['email_google'] = $context_google->e_mail;
           $dataApi[$context_google->name_project]['balanse_google'] = $context_google->ost_bslsnse_go-$sum_accaunt['cost'];
           $dataApi[$context_google->name_project]['clicks_google'] = $click_accaunt['clicks'];
           $dataApi[$context_google->name_project]['clicks_price_google'] = $clicks_price_google;
       }
   }




//    foreach($google_api as $key => $g){
//        $context_google = \App\ProjectContext::find($g->google_project_id);
//        if(isset($context_google) and $context_google->status == 1){
//            $home = new \App\Http\Controllers\HomeController();
//
//            $dataApi[$context_google->name_project]['name_progect_google'] = $context_google->name_project;
//            $dataApi[$context_google->name_project]['email_google'] = $context_google->e_mail;
//            $dataApi[$context_google->name_project]['balanse_google'] = $context_google->ost_bslsnse_go.'(Данные от 23.11.2016) Нет данных обновление сервиса';
//            $dataApi[$context_google->name_project]['clicks_google'] = 'Нет данных обновление сервиса';
//            $dataApi[$context_google->name_project]['clicks_price_google'] = 'Нет данных обновление сервиса';
//        }
//    }


    $error_yandex = array();
    foreach($yandex_api as $key=>$y){
        $context_yandex = \App\ProjectContext::find($y->id_company);
        if(isset($context_yandex) and $context_yandex->status == 1){

            /*$HEADER = array(
                'Accept-Language: ru',
                'Authorization: Bearer '.$y->token_yandex,
                'Content-Type: application/json; charset=utf-8'
            );
            $getBalanse = '{"method":"get","params":{"SelectionCriteria":{},"FieldNames":["Id","StartDate","Statistics","Funds"]}}';
            $ac_ya = $home->curl_request($getBalanse,$HEADER,'https://api.direct.yandex.com/json/v5/campaigns');*/



            $csv = new ParseCsv\Csv();
            $url = 'https://api.direct.yandex.com/json/v5/reports';
            $token = $y->token_yandex;
            $clientLogin = $y->login;

            $params = [
                "params" => [
                    "SelectionCriteria" => [
                        "DateFrom" => (date('Y-m-d', strtotime('-'.$count_day.' days'))),
                        "DateTo" => (date('Y-m-d', strtotime('-1 days'))),
                    ],
                    "FieldNames" => ["CampaignId", "Clicks", "Cost"],
                    "ReportName" => time(),
                    "ReportType" => "CAMPAIGN_PERFORMANCE_REPORT",
                    "DateRangeType" => "CUSTOM_DATE",
                    "Format" => "TSV",
                    "IncludeVAT" => "NO",
                    "IncludeDiscount" => "NO"
                ]
            ];
            $body = json_encode($params);
            $headers = array(
                "Authorization: Bearer $token",
                "Client-Login: $clientLogin",
                "Accept-Language: ru",
                "processingMode: online",
                "returnMoneyInMicros: false",
                "skipReportHeader: true",
                "skipReportSummary: true"
            );
            $clickYandex = $home->curl_request($body,$headers,$url,"TSV");

            if($clickYandex):

                $csv->delimiter = "\t";
                $csv->parse($clickYandex);
                $Cost = 0;
                $Clicks = 0;
                if(is_array($csv->data)){
                    foreach($csv->data as $clicks){

                        $Clicks += $clicks['Clicks'];
                        $Cost += $clicks['Cost'];
                    }
                    if($Clicks)
                    $Cost = round(round($Cost)/$Clicks);
                }


            $dataApi[$context_yandex->name_project]['clicks_yandex'] = $Clicks;
            $dataApi[$context_yandex->name_project]['clicks_price_yandex'] = $Cost;

            $dataApi[$context_yandex->name_project]['name_progect_yandex'] = $context_yandex->name_project;
            $dataApi[$context_yandex->name_project]['email_yandex'] = $context_yandex->e_mail;
            $dataApi[$context_yandex->name_project]['balanse_yandex'] = $context_yandex->ost_bslsnse_ya;

            else:
                $error_yandex[] = $y->login;
            endif;
        }
    }

    if(!empty($error_yandex)){
        $home->error_yandex_mail(implode("<br>", $error_yandex));
    }

    $notice = \App\NoticeSendMail::find(1);

    if($name_project == 'all'){
        foreach($dataApi as $dataAll){
            $home->template_send_mail_client($dataAll,$notice,$count_day);
        }
    }else{
        $home->template_send_mail_client($dataApi[$name_project],$notice,$count_day);
    }

});

//Route::get('/get-balanse-yandex', ['as' => 'getBalanseYandex', 'uses' => 'HomeController@getBalanseYandex']);

Route::get('/get-seranking-sum', function()
{

    $token = "0855c66ecb112b519171b8dcb21f289aa8b0f647";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_HTTPHEADER , ['Authorization: Token '.$token]);
    curl_setopt($curl, CURLOPT_URL, 'https://api4.seranking.com/sites');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
    $out = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($out);

    $date_from = \DB::table('setting_serankings')->select('date_from')->where('id', 1)->first();
	$count_day_serankings = ((int)$date_from->date_from+1);
	
    $date_from = date('Y-m-d', strtotime("-$date_from->date_from days"));
    $arrSum = array();
    foreach($data as $d){
		
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER , ['Authorization: Token '.$token]);
        curl_setopt($curl, CURLOPT_URL, 'https://api4.seranking.com/sites/'.$d->id.'/positions?date_from='.$date_from);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        $out = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($out);

        //dd($data);


        if(isset($data[0]->keywords) && count($data[0]->keywords) > 0){
            foreach($data[0]->keywords as $sum){
                $arrSum[$d->name][] = $sum->total_sum;
            }
        }

    }

    $project_contexts = \DB::table('project_contexts')->get();
    foreach($project_contexts as $c){
        $setting_payout_contexts = \DB::table('setting_payout_contexts')->where('id',1)->first();

        if(empty($c->procent_seo) or $c->enable_procent_seo == 1){
            $context_procent = $setting_payout_contexts->procent_seo;
        }else{
            $context_procent = $c->procent_seo;
        }
        if($context_procent){
            \DB::table('project_contexts')->where('id', $c->id)
                ->update(array(
                    'procent_seo' => $context_procent
                ));
        }
    }


    $name = \DB::table('project_seos')->get();
    foreach($name as $p){
        $setting_payouts = \DB::table('setting_payouts')->where('id',1)->first();

        if(isset($arrSum[trim($p->name_project)])){

            if(empty($p->procent_seo) or $p->enable_procent_seo == 1){
                $p->procent_seo = $setting_payouts->procent_seo;
            }else{
                $p->procent_seo = $p->procent_seo;
            }

            $end_sum = array_sum($arrSum[trim($p->name_project)]);
            $sum_osvoen = ceil($end_sum/$count_day_serankings*30);
            $sum_osvoen_procent = ceil($sum_osvoen/$p->budget*100);




            if($p->osvoeno > $p->budget){
                $budget = $p->budget;
            }else{
                $budget = $p->osvoeno;
            }

            if(empty($budget))
                $budget = 0;

            if(!empty($p->end)) {
                $end = explode('/', $p->end);
            }else{
                $end = array('00','00','0000');
            }
            $data_now = date('m/d/Y');
            if(strtotime($data_now) < strtotime($end[1].'/'.$end[0].'/'.$end[2])) {
                $interval_date = true;
            }else{$interval_date = false;}



            if($interval_date == true){
                if($p->bonus_enable == 1){
                    $procent_bonus = $p->budget / 100 * $p->bonus_add;
                }else{
                    $procent_bonus = $p->budget / 100 * $setting_payouts->bonus_add;
                }

            }else {

                if ($p->procent_bonus == 0 and $p->count_day_fine == 0 and $p->procent_fine == 0) {


                    $enddate = strtotime('+' . $setting_payouts->count_day_fine . ' day', strtotime(preg_replace('~^(\d+)\/(\d+)\/(\d+)$~', '$3/$2/$1', $p->end)));
                    if ($sum_osvoen_procent >= $setting_payouts->procent_bonus) {
                        $procent_bonus = $budget / 100 * $p->procent_seo;
                    } elseif (strtotime("now") > $enddate and $sum_osvoen_procent < $setting_payouts->procent_fine) {
                        $procent_bonus = '-' . ($p->budget - $p->osvoeno) / 100 * $setting_payouts->procent_for_fine;
                    } else {
                        $procent_bonus = 0;
                    }

                } else {
                    $enddate = strtotime('+' . $p->count_day_fine . ' day', strtotime(preg_replace('~^(\d+)\/(\d+)\/(\d+)$~', '$3/$2/$1', $p->end)));
                    if ($sum_osvoen_procent >= $p->procent_bonus) {
                        $procent_bonus = $budget / 100 * $p->procent_seo;
                    } elseif (strtotime("now") > $enddate and $sum_osvoen_procent < $p->procent_fine) {
                        $procent_bonus = '-' . ($p->budget - $p->osvoeno) / 100 * $p->procent_for_fine;
                    } else {
                        $procent_bonus = 0;
                    }

                }

            }



            \DB::table('project_seos')->where('id', $p->id)
                ->update(array(
                    'summa_zp' => $procent_bonus,
                    'osvoeno' => $sum_osvoen,
                    'osvoeno_procent' => $sum_osvoen_procent,
                    'procent_seo' => $p->procent_seo,
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
    foreach($balanse_yandex as $k=>$ya){

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

        if(empty($ac_ya->data->Accounts) or empty($ya->token_yandex)){
            $home = new \App\Http\Controllers\HomeController();
            $ostatok_balanse_yandex = $home->get_price_auto_direct($ya->login);
        }else{
            $ostatok_balanse_yandex = $ac_ya->data->Accounts[0]->Amount;
        }

        if(!empty($ostatok_balanse_yandex)){
           $id_com = \DB::table('project_contexts')->where('id',$ya->id_company)->first();
		   if(empty($id_com))
			   continue;
		   
            $summa = (float)$ostatok_balanse_yandex-(float)$id_com->ost_bslsnse_ya;
            if($summa >= 1000){

               $notice = \App\NoticeSendMail::find(1);
                if($notice->status == 1){
                    $id_com->e_mail = $notice->mail;
                }elseif($notice->status == 2){
                    $id_com->e_mail = $id_com->e_mail.','.$notice->mail;
                }

                $to = $id_com->e_mail;

                $subject = 'PRIME - зачислены денежные средства на Яндекс Директ по проекту: '.$id_com->name_project;


                $homecon = new \App\Http\Controllers\HomeController();
                $message = $homecon->message_add_money($id_com->name_project,'','Y');


                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";



                $headers .= 'From: PRIME <sv@prime-ltd.su>' . "\r\n";


                mail($to, $subject, $message, $headers);

                \DB::table('logs')->insert(
                    array('progect' => 'yandex', 'what_is_done' => 'Отправлено письмо клиенту о пополнении баланса. Email:'.$id_com->e_mail.' balanse Yandex API:'.$ostatok_balanse_yandex.' balanse database:'.$id_com->ost_bslsnse_ya,'who_did' => 'API direct.yandex','created_at' => date('Y-m-d H:i:s'))
                );
            }
        }

        if(!empty($ostatok_balanse_yandex)){
            \DB::table('project_contexts')
                ->where('id', $ya->id_company)
                ->update(array(
                    'ost_bslsnse_ya' => $ostatok_balanse_yandex
                ));
        }

    }
    \DB::table('logs')->insert(
        array('progect' => 'yandex', 'what_is_done' => 'Обновление скрипта direct.yandex','who_did' => 'API direct.yandex','created_at' => date('Y-m-d H:i:s'))
    );
});

////TEST/////
Route::get('/testing', function()
{
    var_dump("test");
});
////TEST/////

Route::get('/get-balanse-google', function() {

    $results = \DB::table('google_apis')->get();
    foreach($results as $r){

        $status = \DB::table('project_contexts')->where('id', $r->google_project_id)->first();
        if(!$status->status)
            continue;


        $sum_accaunt = \App\Http\Controllers\AdWordsController::main($r->google_id_client,"ALL_TIME");

        \DB::table('google_apis')
            ->where('id', $r->id)
            ->update(array(
                'sum' => $sum_accaunt['cost']
            ));
    }

    \DB::table('logs')->insert(
        array('progect' => 'google', 'what_is_done' => 'Обновление скрипта сумма расходов google.api','who_did' => 'API google.adwords','created_at' => date('Y-m-d H:i:s'))
    );

});


Route::auth();

Route::get('/', ['as' => 'index', 'uses' => 'HomeController@index']);



Route::get('/settings-position', ['as' => 'settingsPosition', 'uses' => 'HomeController@settingsPosition']);
Route::get('/back-up-se-ran-pos-get/{id}', ['as' => 'backUpSeRanPosGet', 'uses' => 'HomeController@backUpSeRanPosGet']);

Route::post('/settings-notice-mail-update', ['as' => 'settingsNoticeMailUpdate', 'uses' => 'HomeController@settingsNoticeMailUpdate']);

//Архив
Route::get('/archive-page-project/{name}', ['as' => 'archivePageProject', 'uses' => 'HomeController@archivePageProject']);

Route::get('/personal', ['as' => 'personal', 'uses' => 'HomeController@personal']);

Route::post('/update-token-yandex-form', ['as' => 'updateTokenYandexForm', 'uses' => 'HomeController@updateTokenYandexForm']);
Route::post('/update-id-google-form', ['as' => 'updateIdGoogleForm', 'uses' => 'HomeController@updateIdGoogleForm']);
Route::post('/update-ost-google-balanse-api', ['as' => 'updateOstGoogleBalanseApi', 'uses' => 'HomeController@updateOstGoogleBalanseApi']);


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

//Настройка об-ки периода
Route::get('/setting-seranking', ['as' => 'settingSeranking', 'uses' => 'HomeController@settingSeranking']);
Route::post('/save-setting-seranking', ['as' => 'saveSettingSeranking', 'uses' => 'HomeController@saveSettingSeranking']);

//Настройка выплат КОНТЕКСТ
Route::get('/setting-payout-context', ['as' => 'settingPayoutContext', 'uses' => 'HomeController@settingPayoutContext']);
Route::post('/save-setting-payout-context', ['as' => 'saveSettingPayout', 'uses' => 'HomeController@saveSettingPayoutContext']);

//Логи
Route::get('/logs', ['as' => 'viewLogs', 'uses' => 'Controller@viewLogs']);

//ссылки
Route::post('/create-link-user', ['as' => 'createLinkUser', 'uses' => 'HomeController@createLinkUser']);
Route::post('/delite-link-user', ['as' => 'deliteLinkUser', 'uses' => 'HomeController@deliteLinkUser']);
Route::post('/edit-add-link-user', ['as' => 'editAddLinkUser', 'uses' => 'HomeController@editAddLinkUser']);
Route::get('/edit-link-user/{id}/edit', ['as' => 'editLinkUser', 'uses' => 'HomeController@editLinkUser']);

Route::get('/phpinfo', function() {

    return phpinfo();

});
