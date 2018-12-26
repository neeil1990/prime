<?php


namespace App\Http\Controllers;
use App\GoogleApi;
use App\Groups;
use App\LinkUser;
use App\NoticeSendMail;
use App\PassContext;
use App\PassDev;
use App\ProjectContext;
use App\ProjectSeo;
use App\ServiceAndPass;
use App\SettingPayout;
use App\SettingPayoutContext;
use App\Sort;
use App\TokenYandex;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\PassSeo;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        if(!empty(Auth::user()->id)){
            $user = User::where('id', Auth::user()->id)->first();
            if($user->status == 0){
                \Auth::logout();
            }
        }

    }

	public function error_yandex_mail($message){

		$notice = \App\NoticeSendMail::find(1);

		$subject = 'PRIME - Не прошла авторизация по токенам';
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= 'From: PRIME ERROR' . "\r\n";

		$message = 'Логин<br>'.$message;

		mail($notice->mail, $subject, $message, $headers);

	}


    public function template_send_mail_client($dataAll,$notice,$count_day){

        if($notice->status == 1){
            $email = $notice->mail;
        }elseif($notice->status == 2){
            if(isset($dataAll['email_google'])){
                $email = $dataAll['email_google'].','.$notice->mail;
            }elseif(isset($dataAll['email_yandex'])){
                $email = $dataAll['email_yandex'].','.$notice->mail;
            }
        }else{
            if(isset($dataAll['email_google'])){
                $email = $dataAll['email_google'];
            }elseif(isset($dataAll['email_yandex'])){
                $email = $dataAll['email_yandex'];
            }
        }

        if(isset($dataAll['name_progect_google'])){
            $name_project = $dataAll['name_progect_google'];
        }elseif(isset($dataAll['name_progect_yandex'])){
            $name_project = $dataAll['name_progect_yandex'];
        }

        if(isset($dataAll['clicks_yandex'])) {
            $itog_click_ya = $dataAll['clicks_yandex'];
        }else{
            $itog_click_ya = 0;
        }
        if(isset($dataAll['clicks_google'])) {
            $itog_click_go = $dataAll['clicks_google'];
        }else{
            $itog_click_go = 0;
        }
        $itog = $itog_click_ya+$itog_click_go;

        if(isset($dataAll['balanse_yandex'])) {
            $balanse_yandex = $dataAll['balanse_yandex'];
        }else{
            $balanse_yandex = 'NoN';
        }
        if(isset($dataAll['balanse_google'])) {
            $balanse_google = $dataAll['balanse_google'];
        }else{
            $balanse_google = 'NoN';
        }
        if(isset($dataAll['clicks_yandex'])) {
            $clicks_yandex = $dataAll['clicks_yandex'];
        }else{
            $clicks_yandex = 'NoN';
        }
        if(isset($dataAll['clicks_google'])) {
            $clicks_google = $dataAll['clicks_google'];
        }else{
            $clicks_google = 'NoN';
        }
        if(isset($dataAll['clicks_price_yandex'])) {
            $clicks_price_yandex = $dataAll['clicks_price_yandex'];
        }else{
            $clicks_price_yandex = 'NoN';
        }
        if(isset($dataAll['clicks_price_google'])) {
            $clicks_price_google = $dataAll['clicks_price_google'];
        }else{
            $clicks_price_google = 'NoN';
        }


        $message = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="initial-scale=1.0"/>
<meta name="format-detection" content="telephone=no"/>
	<title>PRIME - '.$name_project.'</title>
<link rel="stylesheet" href="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/public/dist/css/api-email-all.css">
<meta name="robots" content="noindex,follow" />
</head>
<body>
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td align="center">
				<table class="col-600" width="600" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td align="center"  valign="top" background="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/public/dist/img/email/header-background.jpg" bgcolor="#66809b" style="background-size:cover; background-position:top;height="400"">
							<table class="col-600" width="600" height="400" border="0" align="center" cellpadding="0" cellspacing="0">
								<tr>
									<td height="40"></td>
								</tr>
								<tr>
									<td align="center" style="line-height: 0px;">
										<img style="display:block; line-height:0px; font-size:0px; border:0px;" src="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/public/dist/img/email/logo.png" width="109" height="103" alt="logo" />
									</td>
								</tr>
								<tr>
									<td align="center" style="font-family: \'Roboto\', sans-serif; font-size:37px; color:#ffffff; line-height:24px; font-weight: bold;">
										Отчет <span style="font-family: \'Roboto\', sans-serif; font-size:37px; color:#ffffff; line-height:39px; font-weight: 300;">о работе контекстной рекламы</span>
									</td>
								</tr>
								<tr>
									<td align="center" style="font-family: \'Roboto\', sans-serif; font-size:15px; color:#ffffff; line-height:24px; font-weight: 300;">
										Для сайта <b>'.$name_project.'</b> за '.$count_day.' дн.
									</td>
								</tr>
								<tr>
									<td height="50"></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="center">
				<table class="col-600" width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-left:20px; margin-right:20px; border-left: 1px solid #dbd9d9; border-right: 1px solid #dbd9d9;">
					<tr>
						<td height="35"></td>
					</tr>
					<tr>
						<td align="center" style="font-family: \'Raleway\', sans-serif; font-size:22px; font-weight: bold; color:#2a3a4b;">Количество полученных переходов за период</td>
					</tr>
					<tr>
						<td height="10"></td>
					</tr>
					<tr>
						<td align="center" style="font-family: \'Lato\', sans-serif; font-size:14px; color:#757575; line-height:24px; font-weight: 300;">
							Если стоит значение NoN, значит, реклама в данной системе не ведется.
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="center">
				<table class="col-600" width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border-left: 1px solid #dbd9d9; border-right: 1px solid #dbd9d9; ">
					<tr>
						<td height="10"></td>
					</tr>
					<tr>
						<td>
							<table class="col3"  width="183" border="0" align="left" cellpadding="0" cellspacing="0">
								<tr>
									<td height="30"></td>
								</tr>
								<tr>
									<td align="center">
										<table class="insider" width="133" border="0" align="center" cellpadding="0" cellspacing="0">

											<tr align="center" style="line-height:0px;">
												<td>
													<img style="display:block; line-height:0px; font-size:0px; border:0px;" src="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/public/dist/img/email/icon-about.png" width="69" height="78" alt="icon" />
												</td>
											</tr>
											<tr>
												<td height="15"></td>
											</tr>
											<tr align="center">
												<td style="font-family: \'Raleway\', Arial, sans-serif; font-size:20px; color:#2b3c4d; line-height:24px; font-weight: bold;">Я.Директ</td>
											</tr>
											<tr>
												<td height="10"></td>
											</tr>
											<tr align="center">
												<td style="font-family: \'Lato\', sans-serif; font-size:14px; color:#757575; line-height:24px; font-weight: 300;">'.$clicks_yandex.' переходов</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td height="30" ></td>
								</tr>
							</table>
							<table width="1" height="20" border="0" cellpadding="0" cellspacing="0" align="left" >
								<tr>
									<td height="20" style="font-size: 0;line-height: 0;border-collapse: collapse;">
										<p style="padding-left: 24px;">&nbsp;</p>
									</td>
								</tr>
							</table>
							<table class="col3"  width="183" border="0" align="left" cellpadding="0" cellspacing="0">
								<tr>
									<td height="30"></td>
								</tr>
								<tr>
									<td align="center">
										<table class="insider" width="133" border="0" align="center" cellpadding="0" cellspacing="0">

											<tr align="center" style="line-height:0px;">
												<td>
													<img style="display:block; line-height:0px; font-size:0px; border:0px;" src="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/public/dist/img/email/icon-team.png" width="69" height="78" alt="icon" />
												</td>
											</tr>
											<tr>
												<td height="15"></td>
											</tr>
											<tr align="center">
												<td style="font-family: \'Raleway\', sans-serif; font-size:20px; color:#2b3c4d; line-height:24px; font-weight: bold;">G.Adwords</td>
											</tr>
											<tr>
												<td height="10"></td>
											</tr>
											<tr align="center">
													<td style="font-family: \'Lato\', sans-serif; font-size:14px; color:#757575; line-height:24px; font-weight: 300;">'.$clicks_google.' переходов</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td height="30"></td>
								</tr>
							</table>
							<table width="1" height="20" border="0" cellpadding="0" cellspacing="0" align="left">
								<tr>
									<td height="20" style="font-size: 0;line-height: 0;border-collapse: collapse;">
										<p style="padding-left: 24px;">&nbsp;</p>
									</td>
								</tr>
							</table>
							<table class="col3" width="183" border="0" align="right" cellpadding="0" cellspacing="0">
								<tr>
									<td height="30"></td>
								</tr>
								<tr>
									<td align="center">
										<table class="insider" width="133" border="0" align="center" cellpadding="0" cellspacing="0">

											<tr align="center" style="line-height:0px;">
												<td>
													<img style="display:block; line-height:0px; font-size:0px; border:0px;" src="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/public/dist/img/email/icon-portfolio.png" width="69" height="78" alt="icon" />
												</td>
											</tr>
											<tr>
												<td height="15"></td>
											</tr>
											<tr align="center">
												<td style="font-family: \'Raleway\',  sans-serif; font-size:20px; color:#2b3c4d; line-height:24px; font-weight: bold;">Всего</td>
											</tr>
											<tr>
												<td height="10"></td>
											</tr>
											<tr align="center">
												<td style="font-family: \'Lato\', sans-serif; font-size:14px; color:#757575; line-height:24px; font-weight: 300;">'.$itog.' чел.</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td height="30"></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
			<tr>
					<td height="5"></td>
		</tr>
		<tr>
			<td align="center">
				<table align="center" class="col-600" width="600"  border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td align="center" bgcolor="#2a3b4c">
							<table class="col-600" width="600" align="center" width="600" border="0" cellspacing="0" cellpadding="0">
								<tr>
								</tr>
								<tr>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="center">
				<table width="600" class="col-600" align="center" border="0" cellspacing="0" cellpadding="0" style=" border-left: 1px solid #dbd9d9; border-right: 1px solid #dbd9d9;">
					<tr>
						<td height="50"></td>
						<tr>
						<td align="center" style="font-family: \'Raleway\', sans-serif; font-size:22px; font-weight: bold; color:#2a3a4b;">Остаток на балансах рекламных систем</td>

					</tr>
					<tr>
						<td height="10"></td>
					</tr>
					<tr>
						<td align="center" style="font-family: \'Lato\', sans-serif; font-size:14px; color:#757575; line-height:24px; font-weight: 300;">
							Если стоит значение NoN, значит, реклама в данной системе не ведется.
						</td>
					</tr>
					<tr>
						<td height="10"></td>
					</tr>
					</tr>
					<tr>
						<td>
							<table style="border:1px solid #e2e2e2;" class="col2" width="287" border="0" align="left" cellpadding="0" cellspacing="0">
								<tr>
									<td height="40" align="center" bgcolor="#2b3c4d" style="font-family: \'Raleway\', sans-serif; font-size:18px; color:#f1c40f; line-height:30px; font-weight: bold;">Я.Директ</td>
								</tr>
								<tr>
									<td align="center">
										<table class="insider" width="237" border="0" align="center" cellpadding="0" cellspacing="0">
											<tr>
												<td height="20"></td>
											</tr>
											<tr align="center" style="line-height:0px;">
												<td style="font-family: \'Lato\', sans-serif; font-size:35px; color:#2b3c4d; font-weight: bold; line-height: 44px;">'.$balanse_yandex.' руб.</td>
											</tr>
											<tr>
												<td height="15"></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td height="30"></td>
								</tr>
							</table>
							<table width="1" height="20" border="0" cellpadding="0" cellspacing="0" align="left">
								<tr>
									<td height="20" style="font-size: 0;line-height: 0;border-collapse: collapse;">
										<p style="padding-left: 24px;">&nbsp;</p>
									</td>
								</tr>
							</table>
							<table style="border:1px solid #e2e2e2;" class="col2" width="287" border="0" align="right" cellpadding="0" cellspacing="0">
								<tr>
									<td height="40" align="center" bgcolor="#2b3c4d" style="font-family: \'Raleway\', sans-serif; font-size:18px; color:#f1c40f; line-height:30px; font-weight: bold;">G.Adwords</td>
								</tr>
								<tr>
									<td align="center">
										<table class="insider" width="237" border="0" align="center" cellpadding="0" cellspacing="0">
											<tr>
												<td height="20"></td>
											</tr>
											<tr align="center" style="line-height:0px;">
												<td style="font-family: \'Lato\', sans-serif; font-size:35px; color:#2b3c4d; font-weight: bold; line-height: 44px;">'.$balanse_google.' руб.</td>
											</tr>
											<tr>
												<td height="25"></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td height="20" ></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>

		<tr>
			<td align="center">
				<table width="600" class="col-600" align="center" border="0" cellspacing="0" cellpadding="0" style=" border-left: 1px solid #dbd9d9; border-right: 1px solid #dbd9d9;">
					<tr>
						<td height="50"></td>
						<tr>
						<td align="center" style="font-family: \'Raleway\', sans-serif; font-size:22px; font-weight: bold; color:#2a3a4b;">Средняя цена за переход</td>

					</tr>
					<tr>
						<td height="10"></td>
					</tr>
					<tr>
						<td align="center" style="font-family: \'Lato\', sans-serif; font-size:14px; color:#757575; line-height:24px; font-weight: 300;">
						</td>
					</tr>
					<tr>
						<td height="10"></td>
					</tr>
					</tr>
					<tr>
						<td>
							<table style="border:1px solid #e2e2e2;" class="col2" width="287" border="0" align="left" cellpadding="0" cellspacing="0">
								<tr>
									<td height="40" align="center" bgcolor="#2b3c4d" style="font-family: \'Raleway\', sans-serif; font-size:18px; color:#f1c40f; line-height:30px; font-weight: bold;">Я.Директ</td>
								</tr>
								<tr>
									<td align="center">
										<table class="insider" width="237" border="0" align="center" cellpadding="0" cellspacing="0">
											<tr>
												<td height="20"></td>
											</tr>
											<tr align="center" style="line-height:0px;">
												<td style="font-family: \'Lato\', sans-serif; font-size:35px; color:#2b3c4d; font-weight: bold; line-height: 44px;">'.$clicks_price_yandex.' руб.</td>
											</tr>
											<tr>
												<td height="15"></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td height="30"></td>
								</tr>
							</table>
							<table width="1" height="20" border="0" cellpadding="0" cellspacing="0" align="left">
								<tr>
									<td height="20" style="font-size: 0;line-height: 0;border-collapse: collapse;">
										<p style="padding-left: 24px;">&nbsp;</p>
									</td>
								</tr>
							</table>
							<table style="border:1px solid #e2e2e2;" class="col2" width="287" border="0" align="right" cellpadding="0" cellspacing="0">
								<tr>
									<td height="40" align="center" bgcolor="#2b3c4d" style="font-family: \'Raleway\', sans-serif; font-size:18px; color:#f1c40f; line-height:30px; font-weight: bold;">G.Adwords</td>
								</tr>
								<tr>
									<td align="center">
										<table class="insider" width="237" border="0" align="center" cellpadding="0" cellspacing="0">
											<tr>
												<td height="20"></td>
											</tr>
											<tr align="center" style="line-height:0px;">
												<td style="font-family: \'Lato\', sans-serif; font-size:35px; color:#2b3c4d; font-weight: bold; line-height: 44px;">'.$clicks_price_google.' руб.</td>
											</tr>
											<tr>
												<td height="25"></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td height="20" ></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>

		<tr>
			<td align="center">
				<table class="col-600" width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-left:20px; margin-right:20px;">
		<tr>
			<td align="center">
				<table class="col-600" width="600" border="0" align="center" cellpadding="0" cellspacing="0" style=" border-left: 1px solid #dbd9d9; border-right: 1px solid #dbd9d9;">
					<tr>
						<td height="50"></td>
					</tr>
					<tr>
						<td align="right">
							<table class="col2" width="287" border="0" align="right" cellpadding="0" cellspacing="0">
								<tr>
									<td align="center" style="line-height:0px;">
										<img style="display:block; line-height:0px; font-size:0px; border:0px;" class="images_style" src="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/public/dist/img/email/icon-responsive.png" width="169" height="138" />
									</td>
								</tr>
							</table>
							<table width="287" border="0" align="left" cellpadding="0" cellspacing="0" class="col2" style="">
								<tr>
									<td align="center">
										<table class="insider" width="237" border="0" align="center" cellpadding="0" cellspacing="0">
											<tr align="left">
												<td style="font-family: \'Raleway\', sans-serif; font-size:23px; color:#2a3b4c; line-height:30px; font-weight: bold;">Что это значит?</td>
											</tr>

											<tr>
												<td height="5"></td>
											</tr>
											<tr>
												<td style="font-family: \'Lato\', sans-serif; font-size:14px; color:#7f8c8d; line-height:24px; font-weight: 300;">
													Мы внимательно следим за ходом работы контекстной рекламы вашего сайта и информируем вас о ее ходе. Пожалуйста, вовремя пополняйте баланс систем по счетам, которые мы вам присылаем, чтобы избежать простоя в ротации объявлений.
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="center">
				<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" style=" border-left: 1px solid #dbd9d9; border-right: 1px solid #dbd9d9;">
					<tr>
						<td height="50"></td>
					</tr>
					<tr>
						<td align="center" bgcolor="#34495e">
							<table class="col-600" width="600" border="0" align="center" cellpadding="0" cellspacing="0">
								<tr>
									<td height="35"></td>
								</tr>
								<tr>
									<td align="center" style="font-family: \'Raleway\', sans-serif; font-size:20px; color:#f1c40f; line-height:24px; font-weight: bold;">Есть пожелания и вопросы?</td>
								</tr>
								<tr>
									<td height="20"></td>
								</tr>
								<tr>
									<td align="center" style="font-family: \'Lato\', sans-serif; font-size:14px; color:#fff; line-height: 1px; font-weight: 300;">
										Обратитесь к вашему проект-менеджеру.
									</td>
								</tr>
								<tr>
									<td height="40"></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="center">
				<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" style=" border-left: 1px solid #dbd9d9; border-right: 1px solid #dbd9d9;">

					<tr>
						<td align="center" bgcolor="#34495e" background="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/public/dist/img/email/footer.jpg" height="185">
							<table class="col-600" width="600" border="0" align="center" cellpadding="0" cellspacing="0">
								<tr>
									<td height="25"></td>
								</tr>
									<tr>
									<td align="center" style="font-family: \'Raleway\',  sans-serif; font-size:26px; font-weight: 500; color:#f1c40f;">Вы можете с нами связаться</td>
									</tr>
									<tr>
									<td align="center" style="font-family: \'Roboto\',  sans-serif; font-size:18px; font-weight: 500; color:#f1c40f;">+7(473)-203-01-24</td>
									</tr>
								<tr>
									<td height="25"></td>
								</tr>
								<table align="center" width="35%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td align="center"  width="30%"  style="vertical-align: top;">
											<a href="https://vk.com/primeltd" target="_blank"> <img src="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/public/dist/img/email/icon-fb.png"> </a>
									</td>
									<td align="center" class="margin" width="30%" style="vertical-align: top;">
										 <a href="https://prime-ltd.su/" target="_blank"> <img src="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/public/dist/img/email/icon-twitter.png"> </a>
									</td>
									<td align="center" width="30%" style="vertical-align: top;">
											<a href="mailto:info@prime-ltd.su" target="_blank"> <img src="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/public/dist/img/email/icon-googleplus.png"> </a>
									</td>
								</tr>
								</table>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
						</td>
					</tr>
				</table>
</body>
</html>';


        $subject = 'PRIME - остаток денежных средств и статистика за прошлые '.$count_day.' д. по проекту: '.$name_project.'';
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= 'From: PRIME <sv@prime-ltd.su>' . "\r\n";

         mail($email, $subject, $message, $headers);

        $this->add_logs('Yandex/Google','Отправлена статистика клиенту по проекту '.$name_project.' за '.$count_day.' д.','API Yandex/Google');
    }


    public function curl_request($body,$headers,$url,$Format = "JSON"){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLINFO_HEADER_OUT, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($curl);
		curl_close($curl);

        $clickYandex = ($Format == "JSON") ? json_decode($result) : $result;

        return $clickYandex;
    }


	public function get_price_auto_direct($login){
		if(empty($login)){
			return;
		}
		$hostdb = "direct.prime-ltd.su";
		$userdb = "direct.prime_s";
		$passdb = "m3qcTvUzZR";
		$db = "direct.prime_s";

		$mysqli = new \mysqli($hostdb, $userdb, $passdb, $db);
		$result = $mysqli->query("SELECT u.id,u.login,c.price FROM direct_direct_company AS c LEFT JOIN direct_user AS u ON u.id=c.user WHERE u.login='$login' LIMIT 1");
		$row = $result->fetch_assoc();
		if($row){
			return $row['price'];
		}
	}






    public function index(){

		if($this->admin() == 1) {

			$arDate = array(
				date('Y-m-d', strtotime('-7 days')),
				date('Y-m-d', strtotime('-14 days')),
				date('Y-m-d', strtotime('-21 days')),
				date('Y-m-d', strtotime('-28 days')),
				date('Y-m-d', strtotime('-35 days')),
				date('Y-m-d', strtotime('-42 days')),
				date('Y-m-d', strtotime('-49 days')),
			);

			$stat_users = \DB::table('stat_users')
				->whereIn('date_day',$arDate)
				->orderBy('date_day', 'desc')
				->get();
			$users_all = User::all();
			$progect_seo = \DB::table('project_seos')->where('status', '1')->get();
			$progect_context = \DB::table('project_contexts')->where('status', '1')->get();


			$all_osv_procent_admin = 0;
			foreach($progect_seo as $osv){
				if((int)$osv->osvoeno_procent > 100){
					$osv->osvoeno_procent = 100;
				}
				$all_osv_procent_admin += (int)$osv->osvoeno_procent;
			}

			$arStatForAdminUser = array();
			$arSeeForProjectUserAdmin = array();
			foreach($users_all as $k => $user){

				foreach($stat_users as $su){
					if($user->id == $su->id_user){
						foreach($progect_seo as $p){
							if($p->id == $su->id_project){
								$arStatForAdminUser[$user->name][$p->name_project]['osvoeno_procent_day'][$su->date_day] = $su->osvoeno_procent;
								$arStatForAdminUser[$user->name][$p->name_project]['budget'] = $p->budget;
								$arStatForAdminUser[$user->name][$p->name_project]['osvoeno'] = $p->osvoeno;
								if($p->osvoeno_procent > 100) {
									$arStatForAdminUser[$user->name][$p->name_project]['osvoeno_procent'] = 100;
								}else{
									$arStatForAdminUser[$user->name][$p->name_project]['osvoeno_procent'] = $p->osvoeno_procent;
								}
								$arSeeForProjectUserAdmin[$p->osvoeno_procent]['name'] = $user->name;
								$arSeeForProjectUserAdmin[$p->osvoeno_procent]['name_project'] = $p->name_project;
							}
						}
					}
				}
			}


			$osvoeno_all = \DB::table('stats')
				->where('project', 'seo')
				->where('data', date('Y-m-d'))
				->first();
			if(!empty($osvoeno_all->summa)) {
				$osvoeno_all = $osvoeno_all->summa;
			}else{
				$osvoeno_all = '';
			}

			$context_ya_go = \DB::table('stats')
				->where('project', 'context')
				->where('data', date('Y-m-d'))
				->first();
			if(!empty($context_ya_go->summa)) {
				$context_ya_go = $context_ya_go->summa;
			}else {
				$context_ya_go = '';
			}

			$all_user = \DB::table('stats')
				->where('project', 'all')
				->where('data', date('Y-m-d'))
				->first();

			if(!empty($all_user->summa)) {
				$all_user_summa = unserialize($all_user->summa);
			}else{
				$all_user_summa = '';
			}
			$arMaxBudjet = array();
			foreach ($progect_seo as $s) {
				$arMaxBudjet['seo'][] = $s->budget;
			}

			foreach ($progect_context as $c) {
				if ($c->ya_direct != 0 and !empty($c->ya_direct))
					$arMaxBudjet['context']['ya_direct'][] = $c->ya_direct;
				if ($c->go_advords != 0 and !empty($c->go_advords))
					$arMaxBudjet['context']['go_advords'][] = $c->go_advords;
				if ($c->MyTarget != 0 and !empty($c->MyTarget))
					$arMaxBudjet['context']['MyTarget'][] = $c->MyTarget;
			}
		}else{
			//для пользователя
			$progect_seo_user = \DB::table('project_seos')->where('status', '1')->where('id_glavn_user',$this->user_now()->id)->get();
			$project_contexts_user = \DB::table('project_contexts')->where('status', '1')->where('id_glavn_user',$this->user_now()->id)->get();

			$all_osv_progect_seo_user = '';
			foreach($progect_seo_user as $osv){
				if($osv->osvoeno_procent > 100){
					$osv->osvoeno_procent = 100;
				}
				$all_osv_progect_seo_user += $osv->osvoeno_procent;
			}

			if(!empty($all_osv_progect_seo_user)){
				$all_osv_progect_seo_user = round($all_osv_progect_seo_user/count($progect_seo_user),2);
			}else{
				$all_osv_progect_seo_user = 100;
			}


			$arDate = array(
				date('Y-m-d', strtotime('-7 days')),
				date('Y-m-d', strtotime('-14 days')),
				date('Y-m-d', strtotime('-21 days')),
				date('Y-m-d', strtotime('-28 days')),
				date('Y-m-d', strtotime('-35 days')),
				date('Y-m-d', strtotime('-42 days')),
				date('Y-m-d', strtotime('-49 days')),
			);

			//dd($progect_seo_user);
			$stat_users = \DB::table('stat_users')
				->whereIn('date_day',$arDate)
				->where('id_user',$this->user_now()->id)
				->orderBy('date_day', 'desc')
				->get();

			$arSeeForProject = array();
			$arStatUser = array();
			foreach($progect_seo_user as $k => $p){
				$arStatUser[$k]['name_project'] = $p->name_project;
				$arStatUser[$k]['budget'] = $p->budget;
				$arStatUser[$k]['osvoeno'] = $p->osvoeno;
				$arStatUser[$k]['osvoeno_procent'] = $p->osvoeno_procent;
				foreach($stat_users as $key => $s){
					if($s->id_project == $p->id){
						$arStatUser[$k]['osvoeno_procent_day'][$s->date_day] = $s->osvoeno_procent;
					}
				}

				$arSeeForProject[$p->osvoeno_procent] = $p->name_project;
			}
			ksort($arSeeForProject);
			$i = 1;
			foreach($arSeeForProject as $k => $a){
				if($i > 3){
					unset($arSeeForProject[$k]);
				}else {
					$arSeeForProject[$k] = $a;
				}
				$i++;
			}
			//dd($arSeeForProject);

		}

		if($this->admin() == 1) {

			return view('index', [
				'all_osv_procent_admin' => round($all_osv_procent_admin/count($progect_seo),2),
				'all_not_osv_procent_admin' => 100 - round($all_osv_procent_admin/count($progect_seo),2),
				'arStatForAdminUser' => $arStatForAdminUser,
				'arSeeForProjectUserAdmin' => $arSeeForProjectUserAdmin,
				'all_user' => $all_user_summa,
				'context_ya_go' => $context_ya_go,
				'osvoeno_all' => $osvoeno_all,
				'max_budjet_seo' => array_sum($arMaxBudjet['seo']),
				'ya_direct' => array_sum($arMaxBudjet['context']['ya_direct']),
				'go_advords' => array_sum($arMaxBudjet['context']['go_advords']),
				'MyTarget' => array_sum($arMaxBudjet['context']['MyTarget']),
				'progect_context' => $progect_context,
				'progect_seo' => $progect_seo,
				'users_now' => $this->user_now(),
				'admin' => $this->admin(),
				'linkUser' => $this->LinkUser()
			]);
		}else{
			return view('index_user', [
				'all_osv_progect_seo_user' => $all_osv_progect_seo_user,
				'all_not_osv_progect_seo_user' => 100 - $all_osv_progect_seo_user,
				'users_table_stat' => $arStatUser,
				'seo_progect_all' => count($progect_seo_user),
				'project_contexts_user' => count($project_contexts_user),
				'SeeForProject' => $arSeeForProject,
				'users_now' => $this->user_now(),
				'admin' => $this->admin(),
				'linkUser' => $this->LinkUser()
			]);
		}
    }


	public function settingsPosition(Request $request){

		if($this->admin() == 0){
			return die('Nooo!');
		}

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, 'http://online.seranking.com/structure/clientapi/v2.php?method=login&login=work-api&pass='.md5('wcKcY2fgay').'');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
		$out = curl_exec($curl);
		curl_close($curl);
		$token = json_decode($out);



		$ArTotalSum = array(
			'name' => '',
			'max_budjet' => '',
			'total_sum' => ''
		);
		if($request->id_project and $request->date_stat){
			$data = explode(' - ',$request->date_stat);
			$id_project = explode('_',$request->id_project);

				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, 'http://online.seranking.com/structure/clientapi/v2.php?method=stat&siteid='.$id_project[0].'&dateStart='.$data[0].'&dateEnd='.$data[1].'&token='.$token->token.'');
				curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
				$out = curl_exec($curl);
				curl_close($curl);
				$data_pos = json_decode($out);


			if($request->start_pos and $request->end_pos and $request->col_pos) {

				$arSendPos = array();
				$inc = 0;
				foreach($data_pos[0]->keywords as $pos){ //цыкл колличество фраз
					//dd($pos);
					foreach($pos->positions as $k => $p){ // колл дней
						if($p->pos > $request->start_pos and $p->pos < $request->end_pos){
							$arSendPos[$inc]['seID'] = $data_pos[0]->seID;
							$arSendPos[$inc]['regionID'] = $data_pos[0]->regionID;
							$arSendPos[$inc]['id'] = $pos->id;
							$arSendPos[$inc]['pos'] = $p->pos;
							$arSendPos[$inc]['date'] = $p->date;
							$inc++;
						}
					}
				}

				//dd($arSendPos);
				if($arSendPos) {
					\DB::table('back_up_se_ran_pos')->insert(
						array(
							'name_project' => $id_project[1],
							'ar_position' => serialize($arSendPos),
							'created_at' => date('Y-m-d H:i:s')
						)
					);

					foreach ($arSendPos as $editpos) {
						if ($request->plus_pos == '+') {
							$editpos['pos'] += $request->col_pos;
						} else {
							$editpos['pos'] -= $request->col_pos;
						}
						$curl = curl_init();
						curl_setopt($curl, CURLOPT_URL, 'http://online.seranking.com/structure/clientapi/v2.php?method=setPosition&keyword_id=' . $editpos['id'] . '&date=' . $editpos['date'] . '&position=' . $editpos['pos'] . '&search_engine_uid=' . $editpos['seID'] . '~' . $editpos['regionID'] . '&token=' . $token->token . '');
						curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
						$out = curl_exec($curl);
						curl_close($curl);

					}
				}
			}

			foreach($data_pos[0]->keywords as $pos){
				$ArTotalSum['sum'][] = $pos->total_sum;
			}
			$project_seos = \DB::table('project_seos')->where('name_project',$id_project[1])->first();
			$ArTotalSum['total_sum'] = array_sum($ArTotalSum['sum']);
			$ArTotalSum['name'] = $id_project[1];
			$ArTotalSum['max_budjet'] = $project_seos->budget;
			unset($ArTotalSum['sum']);
		}
		$back_up_se_ran_pos = \DB::table('back_up_se_ran_pos')->get();
		if(!isset($back_up_se_ran_pos[0]->id)){
			$back_up_se_ran_pos = array();
		}


		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, 'http://online.seranking.com/structure/clientapi/v2.php?method=sites&token='.$token->token.'');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
		$out = curl_exec($curl);
		curl_close($curl);
		$project = json_decode($out);



		return view('page.settings_position',[
			'back_up_se_ran_pos' => $back_up_se_ran_pos,
			'ArTotalSum' => $ArTotalSum,
			'project' => $project,
			'admin' => $this->admin(),
			'linkUser' => $this->LinkUser()
		]);
	}

	public function backUpSeRanPosGet($id){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, 'http://online.seranking.com/structure/clientapi/v2.php?method=login&login=work-api&pass='.md5('wcKcY2fgay').'');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
		$out = curl_exec($curl);
		curl_close($curl);
		$token = json_decode($out);

		$back_up = \DB::table('back_up_se_ran_pos')->where('id',$id)->first();

		foreach(unserialize($back_up->ar_position) as $editpos){
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, 'http://online.seranking.com/structure/clientapi/v2.php?method=setPosition&keyword_id=' . $editpos['id'] . '&date=' . $editpos['date'] . '&position=' . $editpos['pos'] . '&search_engine_uid=' . $editpos['seID'] . '~' . $editpos['regionID'] . '&token=' . $token->token . '');
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			$out = curl_exec($curl);
			curl_close($curl);
		}
		\DB::table('back_up_se_ran_pos')->where('id',$id)->delete();
		return redirect()->intended('/settings-position');
	}

	public function getAjaxStat(Request $request){
		if($request->type == 'seo'){
			$result = \DB::table('stats')
				->where('project','seo')
				->where('data',$request->date)
				->first();
		}
		if($request->type == 'context'){
			$result = \DB::table('stats')
				->where('project','context')
				->where('data',$request->date)
				->first();
		}

		if($request->type == 'all') {
			$result = new \stdClass();
			$all_user = \DB::table('stats')
				->where('project', 'all')
				->where('data', $request->date)
				->first();

			if(isset($all_user->summa)) {

				ob_start();
				?>
				<tr>
					<th>№</th>
					<th>Имя</th>
					<th>Количество проектов SEO</th>
					<th>Бюджет SEO</th>
					<th>Бюджет освоенный SEO</th>
					<th>Контекст <br> Директ/Adwords</th>
					<th>Оплата по контексту</th>
				</tr>
				<? foreach (unserialize($all_user->summa) as $k => $u) { ?>
					<tr>
						<td>1</td>
						<td><?= $k ?></td>
						<td><? if (isset($u['count_project'])) {
								print $u['count_project'];
							} ?></td>
						<td><? if (isset($u['budjet'])) {
								print $u['budjet'];
							} ?></td>
						<td><? if (isset($u['osvoeno'])) {
								print $u['osvoeno'];
							} ?></td>
						<td><? if (isset($u['context_ya_direct_count'])) {
								print $u['context_ya_direct_count'];
							} ?> / <? if (isset($u['context_go_advords_count'])) {
								print $u['context_go_advords_count'];
							} ?></td>
						<td><? if (isset($u['context_ya_direct_go_advords'])) {
								print $u['context_ya_direct_go_advords'];
							} ?></td>
					</tr>
					<?
				}
				$out1 = ob_get_contents();

				ob_end_clean();
				$result->summa = $out1;

			}
		}


		if(isset($result->summa)){
			return $result->summa;
		}else{
			return 'Нет данных';
		}


	}

    public function settingsNoticeMailUpdate(Request $request){

        $this->validate($request, [
            'notice_email' => 'required',
        ]);

        \DB::table('notice_send_mails')->where('id',1)->update(array('mail' => trim($request['notice_email']),'status' => trim($request['notice_enable_disable'])));
        return redirect()->intended('/project-context');
    }

    public function user_now(){
        $users_now = User::where('id', Auth::user()->id)->first();
        return $users_now;
    }

    public function user_get_id($id){
        $users_now = User::where('id', $id)->first();
        return $users_now;
    }

    public function admin(){
        $users = User::whereRaw('id = ? and admin = 1', [$this->user_now()->id])->count();
        return $users;
    }




    public function archivePageProject($name){

        if($name == 'project-seo'){
            return $this->projectSeo(0);
        }
        if($name == 'pass-seo'){
            return $this->passSEO(0);
        }
        if($name == 'pass-dev'){
            return $this->passDev(0);
        }
        if($name == 'project-context'){
            return $this->projectContext(0);
        }
        if($name == 'pass-context'){
            return $this->passContext(0);
        }
        if($name == 'service-and-password'){
            return $this->serviceAndPassword(0);
        }
        if($name == 'personal'){
            return $this->personal(0);
        }
        //dd($name);

        return view('page.archive-page-project',[
            'admin' => $this->admin(),
            'linkUser' => $this->LinkUser()
        ]);
    }




    public function updateTokenYandexForm(Request $request){


        \Session::put('yandex_token_id', $request['yandex_token_id']);

        $results = \DB::table('token_yandexes')->where('id_company', $request['yandex_token_id'])->first();

        if(isset($results->id)){
            \DB::table('token_yandexes')
                ->where('id', $results->id)
                ->update(array(
                    'login' => trim($request['yandex_login_token'])
                ));
        }else{
            TokenYandex::create([
                'id_company' => trim($request['yandex_token_id']),
                'login' => trim($request['yandex_login_token'])
            ]);
        }

        $client_id = '63deb679ff8b483ebb32ca26c141b23e'; // Id приложения

        $url = 'https://oauth.yandex.ru/authorize';

        $params = array(
            'response_type' => 'code',
            'client_id'     => $client_id,
            'display'       => 'popup'
        );

        $link = '' . $url . '?' . urldecode(http_build_query($params)) . '';

        return redirect()->intended($link);


    }

    public function updateIdGoogleForm(Request $request){

        $this->validate($request, [
            'google_id_client' => 'required',
        ]);

		$sum_accaunt = \App\Http\Controllers\AdWordsController::main($request['google_id_client'],"ALL_TIME");

        $results = \DB::table('google_apis')->where('google_project_id', $request['google_project_id'])->first();

        if(isset($results->id)){
            \DB::table('google_apis')
                ->where('id', $results->id)
                ->update(array(
                    'google_id_client' => trim($request['google_id_client']),
                    'sum' => trim($sum_accaunt['cost'])
                ));
        }else{
            GoogleApi::create([
                'google_project_id' => trim($request['google_project_id']),
                'google_id_client' => trim($request['google_id_client']),
                'sum' => trim($sum_accaunt['cost'])
            ]);
        }

        return redirect()->intended('/project-context');

    }

    public function message_add_money($client,$balanse,$inc){

        if($inc == "Y"){
            $icon = 'icon-about';
            $name_inc = '';
            $balanse = 'Я.Директ';
            $text = '';
        }else{
            $name_inc = 'G.Adwords';
            $icon = 'icon-team';
            $text = 'в следующем размере';
        }

        $message = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="initial-scale=1.0"/>
<meta name="format-detection" content="telephone=no"/>
	<title>PRIME - '.$client.'</title>

<link rel="stylesheet" href="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/public/dist/css/api-email-all.css">

<meta name="robots" content="noindex,follow" />
</head>

<body>
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">


		<tr>
			<td align="center">
				<table class="col-600" width="600" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td align="center"  valign="top" background="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/public/dist/img/email/header-background.jpg" bgcolor="#66809b" style="background-size:cover; background-position:top;height="400"">
							<table class="col-600" width="600" height="400" border="0" align="center" cellpadding="0" cellspacing="0">

								<tr>
									<td height="40"></td>
								</tr>


								<tr>
									<td align="center" style="line-height: 0px;">
										<img style="display:block; line-height:0px; font-size:0px; border:0px;" src="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/public/dist/img/email/logo.png" width="109" height="103" alt="logo" />
									</td>
								</tr>



								<tr>
									<td align="center" style="font-family: \'Roboto\', sans-serif; font-size:37px; color:#ffffff; line-height:24px; font-weight: bold;">
										Отчет <span style="font-family: \'Roboto\', sans-serif; font-size:37px; color:#ffffff; line-height:39px; font-weight: 300;">о пополнении баланса РК</span>
									</td>
								</tr>





								<tr>
									<td align="center" style="font-family: \'Roboto\', sans-serif; font-size:15px; color:#ffffff; line-height:24px; font-weight: 300;">
										Для сайта <b>'.$client.'</b>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>




		<tr>
			<td align="center">
				<table class="col-600" width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-left:20px; margin-right:20px; border-left: 1px solid #dbd9d9; border-right: 1px solid #dbd9d9;">
					<tr>
						<td height="20"></td>
					</tr>

					<tr>
						<td align="center" style="font-family: \'Raleway\', sans-serif; font-size:22px; font-weight: bold; color:#2a3a4b;">Зачислены денежные средства на</td>
					</tr>

					<tr>
						<td height="10"></td>
					</tr>


					<tr>
						<td align="center" style="font-family: \'Lato\', sans-serif; font-size:14px; color:#757575; line-height:24px; font-weight: 300;">
							баланс рекламной системы '.$text.':
						</td>
					</tr>

				</table>
			</td>
		</tr>

		<tr>
			<td align="center">
				<table class="col-600" width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border-left: 1px solid #dbd9d9; border-right: 1px solid #dbd9d9; ">


					<tr>
						<td>



							<table class="col3"  width="183" border="0" align="center" cellpadding="0" cellspacing="0">
								<tr>
									<td height="20"></td>
								</tr>
								<tr>
									<td align="center">
										<table class="insider" width="133" border="0" align="center" cellpadding="0" cellspacing="0">

											<tr align="center" style="line-height:0px;">
												<td>
													<img style="display:block; line-height:0px; font-size:0px; border:0px;" src="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/public/dist/img/email/'.$icon.'.png" width="69" height="78" alt="icon" />
												</td>
											</tr>


											<tr>
												<td height="15"></td>
											</tr>


											<tr align="center">
												<td style="font-family: \'Raleway\', sans-serif; font-size:20px; color:#2b3c4d; line-height:24px; font-weight: bold;">'.$balanse.'</td>
											</tr>


											<tr>
												<td height="10"></td>
											</tr>


											<tr align="center">
													<td style="font-family: \'Lato\', sans-serif; font-size:14px; color:#757575; line-height:24px; font-weight: 300;">'.$name_inc.'</td>
											</tr>



										</table>
									</td>
								</tr>
								<tr>
									<td height="30"></td>
								</tr>
							</table>


						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="center">
				<table align="center" class="col-600" width="600"  border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td align="center" bgcolor="#2a3b4c">
							<table class="col-600" width="600" align="center" width="600" border="0" cellspacing="0" cellpadding="0">
								<tr>

								</tr>
								<tr>

								</tr>

							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>


		<tr>
			<td align="center">
				<table class="col-600" width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-left:20px; margin-right:20px;">



		<tr>
			<td align="center">




							<table width="287" border="0" align="left" cellpadding="0" cellspacing="0" class="col2" style="">
								<tr>
									<td align="center">

			</td>
		</tr>




		<tr>
			<td align="center">
				<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" style=" border-left: 1px solid #dbd9d9; border-right: 1px solid #dbd9d9;">


					<tr>


						<td align="center" bgcolor="#34495e">
							<table class="col-600" width="600" border="0" align="center" cellpadding="0" cellspacing="0">
								<tr>
									<td height="35"></td>
								</tr>


								<tr>
									<td align="center" style="font-family: \'Raleway\', sans-serif; font-size:20px; color:#f1c40f; line-height:24px; font-weight: bold;">Есть пожелания и вопросы?</td>
								</tr>


								<tr>
									<td height="20"></td>
								</tr>


								<tr>
									<td align="center" style="font-family: \'Lato\', sans-serif; font-size:14px; color:#fff; line-height: 1px; font-weight: 300;">
										Обратитесь к вашему проект-менеджеру.
									</td>
								</tr>


								<tr>
									<td height="40"></td>
								</tr>

							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>




		<tr>
			<td align="center">
				<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" style=" border-left: 1px solid #dbd9d9; border-right: 1px solid #dbd9d9;">

					<tr>
						<td align="center" bgcolor="#34495e" background="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/public/dist/img/email/footer.jpg" height="185">
							<table class="col-600" width="600" border="0" align="center" cellpadding="0" cellspacing="0">
								<tr>
									<td height="25"></td>
								</tr>

									<tr>
									<td align="center" style="font-family: \'Raleway\',  sans-serif; font-size:26px; font-weight: 500; color:#f1c40f;">Вы можете с нами связаться</td>
									</tr>
									<tr>
									<td align="center" style="font-family: \'Roboto\',  sans-serif; font-size:18px; font-weight: 500; color:#f1c40f;">+7(473)-203-01-24</td>
									</tr>


								<tr>
									<td height="25"></td>
								</tr>



								<table align="center" width="35%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td align="center"  width="30%"  style="vertical-align: top;">
											<a href="https://vk.com/primeltd" target="_blank"> <img src="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/public/dist/img/email/icon-fb.png"> </a>
									</td>

									<td align="center" class="margin" width="30%" style="vertical-align: top;">
										 <a href="https://prime-ltd.su/" target="_blank"> <img src="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/public/dist/img/email/icon-twitter.png"> </a>
									</td>

									<td align="center" width="30%" style="vertical-align: top;">
											<a href="mailto:info@prime-ltd.su" target="_blank"> <img src="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/public/dist/img/email/icon-googleplus.png"> </a>
									</td>
								</tr>
								</table>



							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>


						</td>
					</tr>
				</table>
</body>
</html>';


        return $message;

    }

    public function updateOstGoogleBalanseApi(Request $request){
        $this->validate($request, [
            'ost_bslsnse_go' => 'required|integer',
        ]);
        if(isset($request['send_client_mail'])){

            $notice = NoticeSendMail::find(1);
            if($notice->status == 1){
                $request['client_email'] = $notice->mail;
            }elseif($notice->status == 2){
                $request['client_email'] = $request['client_email'].','.$notice->mail;
            }

            $to = $request['client_email'];

            $subject = 'PRIME - зачислены денежные средства на Google Adwords по проекту: '.$request['client_name_project'];

            $message = $this->message_add_money($request['client_name_project'],'+'.$request['ost_bslsnse_go'].' руб.','G');
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

            $headers .= 'From: PRIME <sv@prime-ltd.su>' . "\r\n";


            mail($to, $subject, $message, $headers);

            $this->add_logs('Google','Отправлено письмо клиенту о пополнении баланса Email:'.$request['client_email'],'API Google Adwords');

        }

        $results = \DB::table('project_contexts')->where('id', $request['id_progect'])->first();
        if($request->plus_minus == '+'){
            $end_sum = (int)$results->ost_bslsnse_go+(int)$request->ost_bslsnse_go;
        }else{
            $end_sum = (int)$results->ost_bslsnse_go-(int)$request->ost_bslsnse_go;
        }

        \DB::table('project_contexts')
            ->where('id', $request['id_progect'])
            ->update(array(
                'ost_bslsnse_go' => $end_sum
            ));

        return redirect()->intended('/project-context');

    }



    public function showProcentGroup(Request $request){

        $procent = \DB::table('groups')
            ->where('specialnost',$request['arr1'])
            ->where('level',$request['arr2'])
            ->get();


       return json_encode($procent[0]);

    }

    public function showLevelGroup(Request $request){

        $procent = \DB::table('groups')
            ->where('specialnost',$request['arr1'])
            ->get();
        return json_encode($procent);
    }


    public function showProcentUsers(Request $request){

        $procent = \DB::table('users')
            ->where('id',$request['arr1'])
            ->get();


        return json_encode($procent[0]);

    }





    //Настройка полей для проектов сео
    public function settingFieldSeo(){

       $arrSettingFieldSeo = \DB::table('setting_fields')->where('table_value','seo')->get();
        return view('page.setting_field_seo',[
            'settings_sield' => $arrSettingFieldSeo,
            'admin' => $this->admin(),
            'linkUser' => $this->LinkUser()
        ]);

    }

    //Настройка полей для проектов context
    public function settingFieldContext(){

        $arrSettingFieldContext = \DB::table('setting_fields')->where('table_value','context')->get();
        return view('page.setting_field_context',[
            'settings_sield' => $arrSettingFieldContext,
            'admin' => $this->admin(),
            'linkUser' => $this->LinkUser()
        ]);

    }

    //Настройка полей для passSeo
    public function settingFieldPassSeo(){

        $arrSettingFieldContext = \DB::table('setting_fields')->where('table_value','pass_seo')->get();
        return view('page.setting_field_pass_seo',[
            'settings_sield' => $arrSettingFieldContext,
            'admin' => $this->admin(),
            'linkUser' => $this->LinkUser()
        ]);
    }

    //Настройка полей для passDev
    public function settingFieldPassDev(){

        $arrSettingFieldContext = \DB::table('setting_fields')->where('table_value','pass_dev')->get();
        return view('page.setting_field_pass_dev',[
            'settings_sield' => $arrSettingFieldContext,
            'admin' => $this->admin(),
            'linkUser' => $this->LinkUser()
        ]);
    }

    //Настройка полей для passContext
    public function settingFieldPassContext(){

        $arrSettingFieldContext = \DB::table('setting_fields')->where('table_value','pass_context')->get();
        return view('page.setting_field_pass_context',[
            'settings_sield' => $arrSettingFieldContext,
            'admin' => $this->admin(),
            'linkUser' => $this->LinkUser()
        ]);
    }

    public function updateSettingField(Request $request){

        \DB::table('setting_fields')
            ->where('field', $request['name'])
            ->where('table_value', $request['table_value'])
            ->update(array(
                'value' => $request['value']
            ));
    }


    public function viewSeoAndContextProject($id){

        $setting_field_seo = \DB::table('setting_fields')->where('table_value','seo')->get();
        $setting_field_context = \DB::table('setting_fields')->where('table_value','context')->get();

        //dd($setting_field_context);

        $name = \DB::table('users')->where('id',$id)->select('name')->first();

        //////////////////////////////
        //// Project SEO
        /////////////////////////////

        $project_seo = \DB::table('sorts')
            ->leftJoin('project_seos','sorts.id_table','=','project_seos.id')
            ->where('sorts.id_user',$id)
            ->where('project_seos.id_glavn_user',$id)
            ->where('project_seos.status',1)
            ->where('sorts.id_type','4')//ProgectSeo
            ->get();

        $arrBudget = array();
        foreach($project_seo as $key=>$u){
            if(!empty($u->end)) {
                $end = explode('/', $u->end);
            }else{
                $end = array('00','00','0000');
            }

            $data_now = date('m/d/Y');
            if(strtotime($data_now) >= strtotime($end[1].'/'.$end[0].'/'.$end[2])){
                $project_seo[$key]->interval_date = 0;
            }else {
                $difference = intval(abs(
                    strtotime($data_now) - strtotime($end[1] . '/' . $end[0] . '/' . $end[2])
                ));
                $project_seo[$key]->interval_date = $difference / (3600 * 24);
            }

            $project_seo[$key]->value_serialize = unserialize($u->value_serialize);


                if($u->budget <= $u->osvoeno){
                    $arrBudget['budget'][] = $u->budget;
                    $arrBudget['osvoeno'][] = $u->budget;
                }else {
                    $arrBudget['budget'][] = $u->budget;
                    $arrBudget['osvoeno'][] = $u->osvoeno;
                }
            


        }
        if(!empty($arrBudget['budget'])){
            $arrBudget['budget'] = array_sum($arrBudget['budget']);
        }else{
            $arrBudget['budget'] = 0;
        }
        if(!empty($arrBudget['osvoeno'])){
            $arrBudget['osvoeno'] = array_sum($arrBudget['osvoeno']);
        }else{
            $arrBudget['osvoeno'] = 0;
        }

        //////////////////////////////
        //// Project SEO END!
        /////////////////////////////


        //////////////////////////////
        //// Project Context
        /////////////////////////////

        $project_context = \DB::table('sorts')
            ->leftJoin('project_contexts','sorts.id_table','=','project_contexts.id')
            ->where('sorts.id_user',$id)
            ->where('project_contexts.id_glavn_user',$id)
            ->where('project_contexts.status',1)
            ->where('sorts.id_type','5')//ProgectContext
            ->get();

        //dd($project_context);

        $arrBuget = array();
        foreach($project_context as $key => $u){
            $sum = $u->ya_direct+$u->go_advords;
            $project_context[$key]->sum_zp = $sum*$u->procent_seo/100;

            $arrBuget[] = $u->ya_direct;
            $arrBuget[] = $u->go_advords;

            $project_context[$key]->value_serialize = unserialize($u->value_serialize);
        }



        //////////////////////////////
        //// Project Context END!
        /////////////////////////////

        return view('page.view-seo-and-context-project',[
            'budget_seo_osvoeno' => $arrBudget,
            'name_user' => $name,
            'project_context' => $project_context,
            'count_seo_prodject' => count($project_seo),
            'users' => $project_seo,
            'users_now' => $this->user_now(),
            'admin' => $this->admin(),
            'linkUser' => $this->LinkUser(),
            'budget_context_project' => array_sum($arrBuget),
            'count_context_project' => count($project_context),
            'setting_field_seo' => $setting_field_seo,
            'setting_field_context' => $setting_field_context
        ]);
    }



    public function updateGroupPositions(Request $request,Groups $groups){

        $posarr = explode(',',$request['arr']);

        $ids = array_keys($posarr);
        foreach($posarr as $i=>$position){
            $groups->UpdateGroupsPosition($position, $ids[$i]);
        }
    }

    public function updatePersonalPositions(Request $request,User $user){

        $posarr = explode(',',$request['arr']);

        $ids = array_keys($posarr);
        foreach($posarr as $i=>$position){
            $user->UpdateUserPosition($position, $ids[$i]);
        }
    }

    public function updatePassSeoPositions(Request $request,PassSeo $passSeo){

        $posarr = explode(',',$request['arr']);

        $ids = array_keys($posarr);
        foreach($posarr as $i=>$position){
            $passSeo->UpdatePassSeoPosition($position, $ids[$i]);
        }
    }

    public function updatePassDevPositions(Request $request,PassDev $passDev){

        $posarr = explode(',',$request['arr']);

        $ids = array_keys($posarr);
        foreach($posarr as $i=>$position){
            $passDev->UpdatePassDevPosition($position, $ids[$i]);
        }
    }

    public function updatePassContextPositions(Request $request, PassContext $context){

        $posarr = explode(',',$request['arr']);

        $ids = array_keys($posarr);
        foreach($posarr as $i=>$position){
            $context->UpdatePassContexPosition($position, $ids[$i]);
        }
    }




    public function personal($archive = 1){


       $user_groups = \DB::table('groups')->orderBy('positions')->get();

        $users = User::whereRaw('id = ? and admin = 1', [Auth::user()->id])->count();
        if($users == 1){
            $users = \DB::table('users')->orderBy('positions')->get();
        }else{
            $users = User::whereRaw('id = ? and admin = 0', [Auth::user()->id])->get();
        }


        $arrItog = array();
        $countArchive = array();
        foreach($users as $key => $us) {
            if($us->status == 0){
                $countArchive['archive'][] = $us->id;
            }else{
                $countArchive['active'][] = $us->id;
            }


            $project_context_itog = \DB::table('project_contexts')
                ->where('project_contexts.status',1)
                ->where('project_contexts.id_glavn_user',$us->id)
                ->get();

            $project_seo_itog = \DB::table('project_seos')
                ->where('project_seos.status',1)
                ->where('project_seos.id_glavn_user',$us->id)
                ->get();

            //var_dump($project_context_itog);
            $arrSeoPlusItog = array();
            $arrSeoMinusItog = array();
            foreach($project_seo_itog as $itog){
                if(!(preg_match('/\-/',$itog->summa_zp,$preg))){
                    $arrSeoPlusItog[] = $itog->summa_zp;
                }else{
                    $arrSeoMinusItog[] = str_replace('-','',$itog->summa_zp);
                }
            }

            //var_dump($arrSeoMinusItog);

            $arrContextItog = array();
            foreach($project_context_itog as $itog){
                $arrContextItog[] = ($itog->ya_direct+$itog->go_advords+$itog->MyTarget)*$itog->procent_seo/100;
            }


            //итог зп по seo
            $users[$key]->procent_seo_itog = array_sum($arrSeoPlusItog)-array_sum($arrSeoMinusItog);

            $users[$key]->contecst_procent = array_sum($arrContextItog);

            $users[$key]->procent_context_itog = array_sum($arrContextItog)+array_sum($arrSeoPlusItog)-array_sum($arrSeoMinusItog);

            //итог зп специалиста
            $users[$key]->itog = $us->sum_many_first+array_sum($arrContextItog)+array_sum($arrSeoPlusItog)-array_sum($arrSeoMinusItog);

            //итоги всех зарплат
            if($us->status == 1) {
                $arrItog['zp'][] = $us->sum_many_first + array_sum($arrContextItog)+array_sum($arrSeoPlusItog)-array_sum($arrSeoMinusItog);
            }

            $project_seos = \DB::table('project_seos')->where('id_glavn_user',$us->id)->where('status',1)->count();
            $project_contexts = \DB::table('project_contexts')->where('id_glavn_user',$us->id)->where('status',1)->count();

            $users[$key]->project_seos_count = $project_seos;
            $users[$key]->project_contexts_count = $project_contexts;
        }


        if(isset($countArchive['archive'])){
           $count_archive = count($countArchive['archive']);
        }else{
            $count_archive = 1;
        }
        
        return view('page.personal',[
            'itog_sum' =>  array_sum($arrItog['zp']),
            'count_user' => count($countArchive['active']),
            'users' => $users,
            'archive' => $archive,
            'count_archive' => $count_archive,
            'user_groups' => $user_groups,
            'users_now' => $this->user_now(),
            'admin' => $this->admin(),
            'linkUser' => $this->LinkUser()
        ]);
    }



    public function createPersonalForm(Groups $groups)
    {
        $group = $groups->all();
        return view('page.create_personal',[
            'users_now' => $this->user_now(),
            'groups' => $group,
            'admin' => $this->admin(),
            'linkUser' => $this->LinkUser()
        ]);
    }

    public function create(Request $request){

        $this->create_logs('Сотрудники',$request['name']);



        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $message = 'Личный кабинет: http://work.prime-ltd.su '.' Логин: '.$request['email'].' '.'Пароль: '.$request['password'];
        mail($request['email'], 'Личный кабинет PRIME', $message);

        if($request['admin'] == null){
            $request['admin'] = 0;
        }
        if(!isset($request['status'])){
            $request['status'] = 0;
        }

        User::create([
            'status' => $request['status'],
            'name' => $request['name'],
            'admin' => $request['admin'],
            'specialism' => $request['specialism'],
            'level' => $request['level'],
            'personal_specialism' => $request['personal_specialism'],
            'seo_procent' => $request['seo_procent'],
            'sum_many_first' => $request['sum_many_first'],
            'contecst_procent' => $request['contecst_procent'],
            'sum_many_last' => $request['sum_many_last'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);

        return redirect()->intended('personal');

    }

    public function delite(Request $request){
        $delite = explode(',',$request['arr']);
        foreach($delite as $del){
            $this->delite_personal_logs($this->user_get_id($del)->name);
            User::whereRaw('id = ?', [$del])->delete();
        }
        return $request['arr'];
    }

    public function delitePassSeo(Request $request){
        $delite = explode(',',$request['arr']);
        foreach($delite as $del){
            $this->delite_logs('pass_seos',$del,'Пароли SEO');
            PassSeo::whereRaw('id = ?', [$del])->delete();
        }
        return $request['arr'];
    }

    public function edit(Request $request,$id,Groups $groups){

        $group = $groups->all();
        $user = User::where('id', $id)->first();
        return view('page.edit_personal',[
            'user' => $user,
            'admin' => $this->admin(),
            'linkUser' => $this->LinkUser(),
            'users_now' => $this->user_now(),
            'groups' => $group
        ]);
    }

    public function editPassSeo($id){

        $user_all = User::all();
        $pass_seo = \DB::table('pass_seos')->where('id',$id)->first();

            $user = \DB::table('sorts')
                ->leftJoin('users','sorts.id_user','=','users.id')
                ->select('sorts.id_user', 'sorts.id','users.name')
                ->where('sorts.id_table',$pass_seo->id)
                ->where('sorts.id_type','1')
                ->get();
       // dd($user);

        $pass_seo->value_serialize = unserialize($pass_seo->value_serialize);

        return view('page.edit_pass_seo',[
            'admin' => $this->admin(),
            'linkUser' => $this->LinkUser(),
            'users' => $pass_seo,
            'user_all' => $user_all,
            'user' => $user,
            'users_now' => $this->user_now()
        ]);
    }


    public function update(Request $request,User $updateUser){
        if($request['admin'] == null){
            $request['admin'] = 0;
        }
        $users = $request->all();

        $updateUser->UpdateUser($users);
        return redirect()->intended('personal');
    }

    public function updatePassSeo(Request $request,PassSeo $passContext){

        $this->validate($request,[
            'name_project' => 'required',
            'id_user' => 'required'
        ]);

        $users_pass_context = $request->all();
        $passContext->UpdatePassSeoUser($users_pass_context);
        return redirect()->intended('pass-seo');
    }


    public function passSEO($archive = 1){

        $setting_field = \DB::table('setting_fields')->where('table_value','pass_seo')->get();

        $users = User::whereRaw('id = ? and admin = 1', [Auth::user()->id])->count();
        if($users == 1){
            $users = \DB::table('pass_seos')->orderBy('positions')->get();
        }else{
            $users = \DB::table('sorts')
            ->leftJoin('users','sorts.id_user','=','users.id')
            ->leftJoin('pass_seos','sorts.id_table','=','pass_seos.id')
            ->where('sorts.id_type','1')
            ->where('pass_seos.name_project','!=','')
            ->where('users.id',Auth::user()->id)
            ->orderBy('pass_seos.positions')
            ->get();
        }

        $countArchive = array();
        foreach($users as $key=>$u){
            if($u->status == 0) {
                $countArchive[] = $u->id;
            }
            $users[$key]->value_serialize = unserialize($u->value_serialize);
        }

       // dd($users);
        $name = \DB::table('sorts')
            ->leftJoin('users','sorts.id_user','=','users.id')
            ->leftJoin('pass_seos','sorts.id_table','=','pass_seos.id')
            ->where('sorts.id_type','1')->get();



        return view('page.pass_seo',[
            'users' => $users,
            'name' => $name,
            'count_archive' => count($countArchive),
            'archive' => $archive,
            'users_now' => $this->user_now(),
            'admin' => $this->admin(),
            'linkUser' => $this->LinkUser(),
            'setting_field' => $setting_field
        ]);
    }

    public function passSeoCreatForm(){

        $user = User::all();
        return view('page.create_pass_seo',[
            'users' => $user ,
            'users_now' => $this->user_now(),
            'admin' => $this->admin(),
            'linkUser' => $this->LinkUser()
        ]);
    }


    public function createPassSeo(Request $request){

        $this->create_logs('Пароли SEO',$request['name_project']);

        $this->validate($request,[
            'name_project' => 'required',
            'id_user' => 'required'
        ]);

        if(!isset($request['status'])){
            $request['status'] = 0;
        }

      $add = PassSeo::create([
            'status' => $request['status'],
            'name_project' => $request['name_project'],
            'id_glavn_user' => $request['id_user_gl'],
            'ssa' => $request['ssa'],
            'ftp' => $request['ftp'],
            'admin_url' => $request['admin_url'],
            'admin_login' => $request['admin_login'],
            'admin_pass' => $request['admin_pass'],
            'login' => $request['login'],
            'password' => $request['password'],
            'value_serialize' => serialize($request['value_serialize'])
        ]);

        foreach($request['id_user'] as $id_user){
            Sort::create([
                'id_user' => $id_user,
                'id_table' => $add->id,
                'id_type' => 1,//PassSeo
            ]);
        }

        return redirect()->intended('/pass-seo');
    }


    public function createGroupForm(){
        $user = User::all();
        return view('page.create_group_form',[
            'users' => $user,
            'users_now' => $this->user_now(),
            'admin' => $this->admin(),
            'linkUser' => $this->LinkUser()
        ]);
    }

    public function createGroups(Request $request){
        Groups::create([
            'specialnost' => $request['specialnost'],
            'level' => $request['level'],
            'oklad' => $request['oklad'],
            'procent_seo' => $request['procent_seo'],
            'procent_context' => $request['procent_context'],
        ]);
        return redirect()->intended('personal');
    }


    public function editGroupForm($id){
        $user_all = User::all();
        //$users = \DB::table('users')->join('groups','users.id','=','groups.id_user')->where('groups.id',$id)->first();
        $users = \DB::table('groups')->where('groups.id',$id)->first();

        //dd($users);
        return view('page.edit_groups',[
            'users' => $users,
            'admin' => $this->admin(),
            'linkUser' => $this->LinkUser(),
            'users_all' => $user_all ,
            'users_now' => $this->user_now()
        ]);
    }

    public function updateGroups(Request $request,Groups $groups){
        $users_up = $request->all();
        $groups->UpdateGroupsUser($users_up);
        return redirect()->intended('personal');
    }


    public function deliteGroup(Request $request){
        $delite = explode(',',$request['arr']);
        foreach($delite as $del){
            Groups::whereRaw('id = ?', [$del])->delete();
        }
        return $request['arr'];
    }


    //пароли контекст
    public function passContext($archive = 1){

        $setting_field = \DB::table('setting_fields')->where('table_value','pass_context')->get();

        $users = User::whereRaw('id = ? and admin = 1', [Auth::user()->id])->count();
        if($users == 1){
            $users = \DB::table('pass_contexts')->orderBy('positions')->get();
        }else{
            $users = \DB::table('sorts')
                ->leftJoin('users','sorts.id_user','=','users.id')
                ->leftJoin('pass_contexts','sorts.id_table','=','pass_contexts.id')
                ->where('sorts.id_type','2')
                ->where('pass_contexts.name_project','!=','')
                ->where('users.id',Auth::user()->id)
                ->orderBy('pass_contexts.positions')
                ->get();
        }

        $countArchive = array();
        foreach($users as $key=>$u){

            if($u->status == 0){
                $countArchive[] = $u->id;
            }

            $users[$key]->value_serialize = unserialize($u->value_serialize);
        }

        // dd($users);
        $name = \DB::table('sorts')
            ->leftJoin('users','sorts.id_user','=','users.id')
            ->leftJoin('pass_contexts','sorts.id_table','=','pass_contexts.id')
            ->where('sorts.id_type','2')->get();

        return view('page.pass_context',[
            'setting_field' => $setting_field,
            'users' => $users,
            'name' => $name,
            'archive' => $archive,
            'count_archive' => count($countArchive),
            'users_now' => $this->user_now(),
            'admin' => $this->admin(),
            'linkUser' => $this->LinkUser()
        ]);

    }

    public function passContextCreatsForm(){
        $user = User::all();
        return view('page.create_pass_context',[
            'users' => $user ,
            'users_now' => $this->user_now(),
            'admin' => $this->admin(),
            'linkUser' => $this->LinkUser()
        ]);
    }

    public function createPassContext(Request $request){

        $this->create_logs('пароли Контекст',$request['name_project']);

        $this->validate($request,[
            'name_project' => 'required',
            'id_user' => 'required'
        ]);



        if(!isset($request['status'])){
            $request['status'] = 0;
        }

       $add = PassContext::create([
            'status' => $request['status'],
            'name_project' => $request['name_project'],
            'id_glavn_user' => $request['id_glavn_user'],
            'loginYandex' => $request['loginYandex'],
            'passYandex' => $request['passYandex'],
            'loginGoogle' => $request['loginGoogle'],
            'passGoogle' => $request['passGoogle'],
            'loginMyTarget' => $request['loginMyTarget'],
            'passMyTarget' => $request['passMyTarget'],
            'value_serialize' => serialize($request['value_serialize'])
        ]);



        foreach($request['id_user'] as $id_user){

            Sort::create([
                'id_user' => $id_user,
                'id_table' => $add->id,
                'id_type' => 2 //PassContext
            ]);
        }

        return redirect()->intended('/pass-context');

    }

    public function delitePassContext(Request $request){
        $delite = explode(',',$request['arr']);
        foreach($delite as $del){
            $this->delite_logs('pass_contexts',$del,'Пароли контекст');
            PassContext::whereRaw('id = ?', [$del])->delete();
        }
        return $request['arr'];
    }

    public function editPassContext($id){

        $user_all = User::all();
        $pass_context = \DB::table('pass_contexts')->where('id',$id)->first();

        $user = \DB::table('sorts')
            ->leftJoin('users','sorts.id_user','=','users.id')
            ->select('sorts.id_user', 'sorts.id','users.name')
            ->where('sorts.id_table',$pass_context->id)
            ->where('sorts.id_type','2')
            ->get();

        $pass_context->value_serialize = unserialize($pass_context->value_serialize);

        return view('page.edit_pass_context',[
            'user' => $user,
            'admin' => $this->admin(),
            'linkUser' => $this->LinkUser(),
            'users' => $pass_context,
            'user_all' => $user_all,
            'users_now' => $this->user_now()
        ]);
    }

    public function updatePassContext(Request $request,PassContext $passContext){

        $this->validate($request,[
            'name_project' => 'required',
            'id_user' => 'required'
        ]);

        $users_pass_context = $request->all();
        $passContext->UpdatePassContextUser($users_pass_context);
        return redirect()->intended('pass-context');
    }



    //DEV Password

    public function passDev($archive = 1){

        $setting_field = \DB::table('setting_fields')->where('table_value','pass_dev')->get();

        $users = User::whereRaw('id = ? and admin = 1', [Auth::user()->id])->count();
        if($users == 1){
            $users = \DB::table('pass_devs')->orderBy('positions')->get();
        }else{
            $users = \DB::table('sorts')
                ->leftJoin('users','sorts.id_user','=','users.id')
                ->leftJoin('pass_devs','sorts.id_table','=','pass_devs.id')
                ->where('sorts.id_type','3')
                ->where('pass_devs.name_project','!=','')
                ->where('users.id',Auth::user()->id)
                ->orderBy('pass_devs.positions')
                ->get();
        }

        $countArchive = array();
        foreach($users as $key=>$u){
            if($u->status == 0){
                $countArchive[] = $u->id;
            }

            $users[$key]->value_serialize = unserialize($u->value_serialize);
        }
        // dd($users);
        $name = \DB::table('sorts')
            ->leftJoin('users','sorts.id_user','=','users.id')
            ->leftJoin('pass_devs','sorts.id_table','=','pass_devs.id')
            ->where('sorts.id_type','3')->get();



        return view('page.pass_dev',[
            'setting_field' => $setting_field,
            'users' => $users,
            'name' => $name,
            'count_archive' => count($countArchive),
            'archive' => $archive,
            'users_now' => $this->user_now(),
            'admin' => $this->admin(),
            'linkUser' => $this->LinkUser()
        ]);
    }

    public function passDevCreatForm(){

        $user = User::all();
        return view('page.create_pass_dev',[
            'users' => $user ,
            'admin' => $this->admin(),
            'linkUser' => $this->LinkUser(),
            'users_now' => $this->user_now()
        ]);

    }

    public function createPassDev(Request $request){

        $this->create_logs('Пароли DEV',$request['name_project']);

        $this->validate($request,[
        'name_project' => 'required',
        'id_user' => 'required'
        ]);

        if(!isset($request['status'])){
            $request['status'] = 0;
        }

        $add = PassDev::create([
            'status' => $request['status'],
            'name_project' => $request['name_project'],
            'id_glavn_user' => $request['id_user_gl'],
            'admin_url' => $request['admin_url'],
            'admin_login' => $request['admin_login'],
            'admin_pass' => $request['admin_pass'],
            'ssa' => $request['ssa'],
            'ftp' => $request['ftp'],
            'login' => $request['login'],
            'password' => $request['password'],
            'value_serialize' => serialize($request['value_serialize'])
        ]);

        foreach($request['id_user'] as $id_user){
            Sort::create([
                'id_user' => $id_user,
                'id_table' => $add->id,
                'id_type' => 3,//PassDev
            ]);
        }

        return redirect()->intended('/pass-dev');

    }

    public function editPassDev($id){

        $user_all = User::all();
        $pass_dev = \DB::table('pass_devs')->where('id',$id)->first();

        $user = \DB::table('sorts')
            ->leftJoin('users','sorts.id_user','=','users.id')
            ->select('sorts.id_user', 'sorts.id','users.name')
            ->where('sorts.id_table',$pass_dev->id)
            ->where('sorts.id_type','3')
            ->get();
        // dd($user);

        $pass_dev->value_serialize = unserialize($pass_dev->value_serialize);

        return view('page.edit_pass_dev',[
            'users' => $pass_dev,
            'admin' => $this->admin(),
            'linkUser' => $this->LinkUser(),
            'user_all' => $user_all,
            'user' => $user,
            'users_now' => $this->user_now()
        ]);

    }

    public function updatePassDev(Request $request, PassDev $passDev){

        $this->validate($request,[
            'name_project' => 'required',
            'id_user' => 'required'
        ]);

        $users_pass_context = $request->all();
        $passDev->UpdatePassDevUser($users_pass_context);
        return redirect()->intended('pass-dev');

    }

    public function delitePassDev(Request $request){
        $delite = explode(',',$request['arr']);
        foreach($delite as $del){
            $this->delite_logs('pass_devs',$del,'Пароли Develop');
            PassDev::whereRaw('id = ?', [$del])->delete();
        }
        return $request['arr'];
    }


    //График работы
    public function WorkGraff(){
        return view('page.work-grafik');
    }

    //Проекты сео

    public function projectSeo($archive = 1){

        $setting_field = \DB::table('setting_fields')->where('table_value','seo')->get();

        $users = User::whereRaw('id = ? and admin = 1', [Auth::user()->id])->count();
        if($users == 1){
            $users = \DB::table('project_seos')->orderBy('positions')->get();
        }else{
            $users = \DB::table('sorts')
                ->leftJoin('users','sorts.id_user','=','users.id')
                ->leftJoin('project_seos','sorts.id_table','=','project_seos.id')
                ->where('sorts.id_type','4')
                ->where('project_seos.name_project','!=','')
                ->where('users.id',Auth::user()->id)
                ->orderBy('project_seos.positions')
                ->get();
        }

        $arrBudget = array();
        $countStatus = array();
        foreach($users as $key=>$u){

            if($u->status == 0){
                $countStatus['countArchive'][] = $u->status;
            }
            if($u->status == 1){
                $countStatus['active'][] = $u->id;
            }

            if(!empty($u->end)) {
                $end = explode('/', $u->end);
            }else{
                $end = array('00','00','0000');
            }

            $data_now = date('m/d/Y');
            if(strtotime($data_now) >= strtotime($end[1].'/'.$end[0].'/'.$end[2])){
                $users[$key]->interval_date = 0;
            }else {
                $difference = intval(abs(
                    strtotime($data_now) - strtotime($end[1] . '/' . $end[0] . '/' . $end[2])
                ));
                $users[$key]->interval_date = $difference / (3600 * 24);
            }

            $users[$key]->value_serialize = unserialize($u->value_serialize);




            if($u->status == $archive) {

              if($u->id_glavn_user == $this->user_now()->id and $this->admin() == 0) {
                  if ($u->budget <= $u->osvoeno) {
                      $arrBudget['budget'][] = $u->budget;
                      $arrBudget['osvoeno'][] = $u->budget;
                  } else {
                      $arrBudget['budget'][] = $u->budget;
                      $arrBudget['osvoeno'][] = $u->osvoeno;
                  }
              }elseif($this->admin() == 1){
                  if ($u->budget <= $u->osvoeno) {
                      $arrBudget['budget'][] = $u->budget;
                      $arrBudget['osvoeno'][] = $u->budget;
                  } else {
                      $arrBudget['budget'][] = $u->budget;
                      $arrBudget['osvoeno'][] = $u->osvoeno;
                  }
              }
            }

        }

        if(!empty($arrBudget['budget'])){
            $arrBudget['budget'] = array_sum($arrBudget['budget']);
        }else{
            $arrBudget['budget'] = 0;
        }
        if(!empty($arrBudget['osvoeno'])){
            $arrBudget['osvoeno'] = array_sum($arrBudget['osvoeno']);
        }else{
            $arrBudget['osvoeno'] = 0;
        }

       // dd($users);

        $name = \DB::table('sorts')
            ->leftJoin('users','sorts.id_user','=','users.id')
            ->leftJoin('project_seos','sorts.id_table','=','project_seos.id')
            ->where('sorts.id_type','4')->get();

        if(empty($countStatus['countArchive'])){
            $countStatus['countArchive'] = 0;
        }else{
            $countStatus['countArchive'] = count($countStatus['countArchive']);
        }

        if(empty($countStatus['active'])){
            $countStatus['active'] = 0;
        }else{
            $countStatus['active'] = count($countStatus['active']);
        }


        return view('page.project-seo',[
            'budget_seo_osvoeno' => $arrBudget,
            'count_seo_prodject' => $countStatus['active'],
            'count_status' => $countStatus['countArchive'],
            'users' => $users,
            'name' => $name,
            'archive' => $archive,
            'users_now' => $this->user_now(),
            'admin' => $this->admin(),
            'setting_field' => $setting_field,
            'linkUser' => $this->LinkUser()
        ]);
    }

    public function projectSeoCreateForm(){
        $user = User::all();
       return view('page.project-seo-crate-form',[
           'users' => $user,
           'admin' => $this->admin(),
           'linkUser' => $this->LinkUser()
       ]);
    }

    public function createProjectSeo(Request $request){

        $this->create_logs('Проекты SEO',$request['name_project']);

        $this->validate($request, [
            'name_project' => 'required',
            'id_glavn_user' => 'required',
            'id_user' => 'required',
        ]);

        if(!isset($request['status'])){
            $request['status'] = 0;
        }


        $add = ProjectSeo::create([
            'name_project' => $request['name_project'],
            'status' => $request['status'],
            'budget' => $request['budget'],
            'osvoeno' => $request['osvoeno'],
            'osvoeno_procent' => $request['osvoeno_procent'],
            'id_glavn_user' => $request['id_glavn_user'],
            'procent_seo' => $request['procent_seo'],
            'summa_zp' => $request['summa_zp'],
            'startpoint' => $request['startpoint'],
            'lp' => $request['lp'],
            'start' => $request['start'],
            'end' => $request['end'],
            'aim' => $request['aim'],
            'region' => $request['region'],
            'dogovor_number' => $request['dogovor_number'],
            'contact_person' => $request['contact_person'],
            'phone_person' => $request['phone_person'],
            'e_mail' => $request['e_mail'],
            'value_serialize' => serialize($request['value_serialize'])
        ]);

        foreach($request['id_user'] as $id_user){
            Sort::create([
                'id_user' => $id_user,
                'id_table' => $add->id,
                'id_type' => 4,//ProjectSeo
            ]);
        }

        return redirect()->intended('/project-seo');

    }


    public function UpdateProjectSeoPosition(Request $request, ProjectSeo $projectSeo){

        $posarr = explode(',',$request['arr']);

        $ids = array_keys($posarr);
        foreach($posarr as $i=>$position){
            $projectSeo->UpdateProjectSeoPosition($position, $ids[$i]);
        }

    }

    public function deliteProjectSeo(Request $request){
        $delite = explode(',',$request['arr']);
        foreach($delite as $del){
            $this->delite_logs('project_seos',$del,'Проекты SEO');
            ProjectSeo::whereRaw('id = ?', [$del])->delete();
        }
        return $request['arr'];
    }

    public function editProjectSeo($id){

        $user_all = User::all();
        $project_seos = \DB::table('project_seos')->where('id',$id)->first();

        $user = \DB::table('sorts')
            ->leftJoin('users','sorts.id_user','=','users.id')
            ->select('sorts.id_user', 'sorts.id','users.name')
            ->where('sorts.id_table',$project_seos->id)
            ->where('sorts.id_type','4')
            ->get();

            $project_seos->value_serialize = unserialize($project_seos->value_serialize);


        return view('page.edit_prodject_seo_form',[
            'users' => $project_seos,
            'admin' => $this->admin(),
            'linkUser' => $this->LinkUser(),
            'user_all' => $user_all,
            'user' => $user,
            'users_now' => $this->user_now()
        ]);
    }

    public function updateProjectSeo(Request $request,ProjectSeo $projectSeo){
        $this->validate($request, [
            'name_project' => 'required',
            'id_glavn_user' => 'required',
            'id_user' => 'required',
        ]);

        $users_pass_context = $request->all();

        $projectSeo->UpdateProjectSeoUser($users_pass_context);
        return redirect()->intended('project-seo');
    }






    //Проекты context

    public function projectContext($archive = 1){

        if (isset($_GET['code'])) {

            $client_id = '63deb679ff8b483ebb32ca26c141b23e'; // Id приложения
            $client_secret = 'd453b19a29624959a06fd26f76aa8075'; // Пароль приложения

            $params = array(
                'grant_type'    => 'authorization_code',
                'code'          => $_GET['code'],
                'client_id'     => $client_id,
                'client_secret' => $client_secret
            );

            $url = 'https://oauth.yandex.ru/token';

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($curl);
            curl_close($curl);

            $tokenInfo = json_decode($result, true);

            if(!empty($tokenInfo['access_token'])) {
                $yandex_token_id = \Session::get('yandex_token_id');

                \DB::table('token_yandexes')
                    ->where('id_company', $yandex_token_id)
                    ->update(array(
                        'token_yandex' => $tokenInfo['access_token']
                    ));
            }
        }

        $setting_field = \DB::table('setting_fields')->where('table_value','context')->get();

        $users = User::whereRaw('id = ? and admin = 1', [Auth::user()->id])->count();
        if($users == 1){
            $users = \DB::table('project_contexts')->orderBy('positions')->get();
        }else{
            $users = \DB::table('sorts')
                ->leftJoin('users','sorts.id_user','=','users.id')
                ->leftJoin('project_contexts','sorts.id_table','=','project_contexts.id')
                ->where('sorts.id_type','5')
                ->where('users.id',Auth::user()->id)
                ->where('project_contexts.name_project','!=','')
                ->orderBy('project_contexts.positions')
                ->get();
        }



        //var_dump($users);

        $arrBuget = array();
        foreach($users as $key => $u){

            $users[$key]->now_bslsnse_go = $u->ost_bslsnse_go;
            $results = \DB::table('google_apis')->where('google_project_id', $u->id)->first();
            if(isset($results->id)){
                $users[$key]->ost_bslsnse_go = $u->ost_bslsnse_go-$results->sum;
                $users[$key]->google_id_client = $results->google_id_client;
            }

			$results_ya = \DB::table('token_yandexes')->where('id_company', $u->id)->first();
			if(isset($results_ya->id)){
				$users[$key]->yandex_login_client = $results_ya->login;
			}

            $sum = (float)$u->ya_direct+(float)$u->go_advords+(float)$u->MyTarget;
            $users[$key]->sum_zp = $sum*$u->procent_seo/100;


            if($u->status == 0){
                $countStatus['countArchive'][] = $u->status;
            }
            if($u->status == 1){
                $countStatus['active'][] = $u->id;
            }


            if($u->status == $archive){
                if($u->id_glavn_user == $this->user_now()->id and $this->admin() == 0) {
                    $arrBuget[] = $u->ya_direct;
                    $arrBuget[] = $u->go_advords;
                    $arrBuget[] = $u->MyTarget;
                }elseif($this->admin() == 1){
                    $arrBuget[] = $u->ya_direct;
                    $arrBuget[] = $u->go_advords;
                    $arrBuget[] = $u->MyTarget;
                }
            }


            $users[$key]->value_serialize = unserialize($u->value_serialize);
        }
        $name = \DB::table('sorts')
            ->leftJoin('users','sorts.id_user','=','users.id')
            ->leftJoin('project_contexts','sorts.id_table','=','project_contexts.id')
            ->where('sorts.id_type','5')->get();

        //dd();

        if(empty($countStatus['countArchive'])){
            $countStatus['countArchive'] = 0;
        }else{
            $countStatus['countArchive'] = count($countStatus['countArchive']);
        }

        if(empty($countStatus['active'])){
            $countStatus['active'] = 0;
        }else{
            $countStatus['active'] = count($countStatus['active']);
        }

        $notice = NoticeSendMail::find(1);

        return view('page.project-context',[
            'budget_context_project' => array_sum($arrBuget),
            'count_context_project' => $countStatus['active'],
            'users' => $users,
            'name' => $name,
            'count_status' => $countStatus['countArchive'],
            'archive' => $archive,
            'users_now' => $this->user_now(),
            'admin' => $this->admin(),
            'linkUser' => $this->LinkUser(),
            'setting_field' => $setting_field,
            'notice' => $notice
        ]);
    }

    public function projectContextCreateForm(){
        $user = User::all();
        return view('page.project_context_create_form',[
            'users' => $user,
            'admin' => $this->admin(),
            'linkUser' => $this->LinkUser()
        ]);
    }

    public function createProjectContext(Request $request){

        $this->create_logs('Проекты Контекст',$request['name_project']);

        $this->validate($request, [
            'name_project' => 'required',
            'id_user' => 'required',
        ]);

        if(!isset($request['status'])){
            $request['status'] = 0;
        }


        $add = ProjectContext::create([
            'status' => $request['status'],
            'id_glavn_user' => $request['id_glavn_user'],
            'name_project' => $request['name_project'],
            'ya_direct' => $request['ya_direct'],
            'go_advords' => $request['go_advords'],
            'MyTarget' => $request['MyTarget'],
            'ost_bslsnse_ya' => $request['ost_bslsnse_ya'],
            'ost_bslsnse_go' => $request['ost_bslsnse_go'],
            'procent_seo' => $request['procent_seo'],
            'dogovor_number' => $request['dogovor_number'],
            'contact_person' => $request['contact_person'],
            'phone_person' => $request['phone_person'],
            'e_mail' => $request['e_mail'],
            'value_serialize' => serialize($request['value_serialize'])
        ]);

        foreach($request['id_user'] as $id_user){
            Sort::create([
                'id_user' => $id_user,
                'id_table' => $add->id,
                'id_type' => 5,
            ]);
        }

        return redirect()->intended('/project-context');

    }

    public function deliteProjectContext(Request $request){
        $delite = explode(',',$request['arr']);
        foreach($delite as $del){
            $this->delite_logs('project_contexts',$del,'Проекты контекст');
            ProjectContext::whereRaw('id = ?', [$del])->delete();
        }
        return $request['arr'];
    }

    public function updateProjectContextPositions(Request $request, ProjectContext $projectContext){

        $posarr = explode(',',$request['arr']);

        $ids = array_keys($posarr);
        foreach($posarr as $i=>$position){
            $projectContext->UpdateProjectContextPosition($position, $ids[$i]);
        }

    }

    public function editProjectContext($id){
        $user_all = User::all();
        $project_contexts = \DB::table('project_contexts')->where('id',$id)->first();

        $user = \DB::table('sorts')
            ->leftJoin('users','sorts.id_user','=','users.id')
            ->select('sorts.id_user', 'sorts.id','users.name')
            ->where('sorts.id_table',$project_contexts->id)
            ->where('sorts.id_type','5')
            ->get();
        // dd($user);

        $project_contexts->value_serialize = unserialize($project_contexts->value_serialize);

        return view('page.edit_prodject_context_form',[
            'users' => $project_contexts,
            'admin' => $this->admin(),
            'linkUser' => $this->LinkUser(),
            'user_all' => $user_all,
            'user' => $user,
            'users_now' => $this->user_now()
        ]);

    }

    public function updateProjectContext(Request $request, ProjectContext $projectContext){
        $this->validate($request, [
            'name_project' => 'required',
            'id_user' => 'required',
        ]);

        $users_pass_context = $request->all();
        $projectContext->UpdateProjectContextUser($users_pass_context);
        return redirect()->intended('project-context');
    }


    //Сервисы & Пароли

    public function serviceAndPassword($archive = 1){

        $setting_field = \DB::table('setting_fields')->where('table_value','service_and_pass')->get();


        $users = User::whereRaw('id = ? and admin = 1', [Auth::user()->id])->count();
        if($users == 1){
            $users = \DB::table('service_and_passes')->orderBy('positions')->get();
        }else{
            $users = \DB::table('sorts')
                ->leftJoin('users','sorts.id_user','=','users.id')
                ->leftJoin('service_and_passes','sorts.id_table','=','service_and_passes.id')
                ->where('sorts.id_type','6')
                ->where('users.id',Auth::user()->id)
                ->where('service_and_passes.name_project','!=','')
                ->orderBy('service_and_passes.positions')
                ->get();
        }

        $name = \DB::table('sorts')
            ->leftJoin('users','sorts.id_user','=','users.id')
            ->leftJoin('service_and_passes','sorts.id_table','=','service_and_passes.id')
            ->where('sorts.id_type','6')->get();

        $countArchive = array();
        foreach($users as $u){
            if($u->status == 0){
                $countArchive[] = $u->id;
            }
        }


        return view('page.service-and-password',[
            'admin' => $this->admin(),
            'linkUser' => $this->LinkUser(),
            'setting_field' => $setting_field,
            'name' => $name,
            'archive' => $archive,
            'count_archive' => count($countArchive),
            'users' => $users
        ]);

    }

    public function serviceAndPasswordCreateForm(){
        $user = User::all();
        return view('page.service-and-password-create-form',[
            'admin' => $this->admin(),
            'linkUser' => $this->LinkUser(),
            'users' => $user
        ]);
    }

    public function createServiceAndPassword(Request $request){

        $this->create_logs('Сервисы & Пароли',$request['name_project']);

        $this->validate($request, [
            'name_project' => 'required',
            'id_user' => 'required',
        ]);


        if(!isset($request['status'])){
            $request['status'] = 0;
        }


        $add = ServiceAndPass::create([
            'status' => $request['status'],
            'name_project' => $request['name_project'],
            'login' => $request['login'],
            'password' => $request['password'],
            'dop_infa' => $request['dop_infa'],
        ]);

        foreach($request['id_user'] as $id_user){
            Sort::create([
                'id_user' => $id_user,
                'id_table' => $add->id,
                'id_type' => 6,
            ]);
        }

        return redirect()->intended('/service-and-password');

    }

    public function deliteServiceAndPass(Request $request){
        $delite = explode(',',$request['arr']);
        foreach($delite as $del){
            $this->delite_logs('service_and_passes',$del,'Сервисы & Пароли');
            ServiceAndPass::whereRaw('id = ?', [$del])->delete();
        }
        return $request['arr'];
    }


    public function editServiceAndPassword($id){

        $user_all = User::all();
        $project_contexts = \DB::table('service_and_passes')->where('id',$id)->first();

        $user = \DB::table('sorts')
            ->leftJoin('users','sorts.id_user','=','users.id')
            ->select('sorts.id_user', 'sorts.id','users.name')
            ->where('sorts.id_table',$project_contexts->id)
            ->where('sorts.id_type','6')
            ->get();
        // dd($user);

        return view('page.edit_service_and_passes_form',[
            'users' => $project_contexts,
            'admin' => $this->admin(),
            'linkUser' => $this->LinkUser(),
            'user_all' => $user_all,
            'user' => $user,
            'users_now' => $this->user_now()
        ]);

    }

    public function updateServiceAndPassword(Request $request,ServiceAndPass $serviceAndPass){

        $this->validate($request, [
            'name_project' => 'required',
            'id_user' => 'required',
        ]);

        $users_pass_context = $request->all();
        $serviceAndPass->UpdateServiceAndPass($users_pass_context);
        return redirect()->intended('service-and-password');


    }

    public function settingFieldServiceAndPassword(){
        $arrSettingFieldSeo = \DB::table('setting_fields')->where('table_value','service_and_pass')->get();
        return view('page.setting-field-service-and-password',[
            'settings_sield' => $arrSettingFieldSeo,
            'admin' => $this->admin(),
            'linkUser' => $this->LinkUser()
        ]);
    }

    /////////////////////////
    ////настройка выплат
    /////////////////////////

    public function settingPayout(){
       $alldata = SettingPayout::all();
        return view('page.setting-payout',[
            'admin' => $this->admin(),
            'linkUser' => $this->LinkUser(),
            'setting_payout' => $alldata[0]
        ]);
    }

    public function saveSettingPayout(Request $request, SettingPayout $settingPayout){
        $settingPayout->UpdateSettingPayout($request->all());
        return redirect()->intended('setting-payout');
    }

	/////////////////////////
	////настройка выплат контекст
	/////////////////////////

	public function settingPayoutContext(){

		$alldata = SettingPayoutContext::all();
		return view('page.setting-payout-context',[
			'admin' => $this->admin(),
			'linkUser' => $this->LinkUser(),
			'setting_payout' => $alldata[0]
		]);
	}

	public function saveSettingPayoutContext(Request $request, SettingPayoutContext $settingPayout){
		$settingPayout->UpdateSettingPayout($request->all());
		return redirect()->intended('setting-payout-context');
	}


    public function createLinkUser(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'link' => 'required',
            'position' => 'integer',
        ]);
        if(!isset($request->status_admin)){
            $request->status_admin = 0;
        }

        LinkUser::create([
            'name' => $request->name,
            'link' => $request->link,
            'position' => $request->position,
            'status_admin' => $request->status_admin,
            'id_user' => $request->id_user
        ]);

        return redirect()->intended($_SERVER['HTTP_REFERER']);

    }

    public function LinkUser(){
      // dd($this->user_now()->id);

        $results = \DB::table('link_users')->orderBy('position')->get();

        $resArr = array();
        foreach($results as $r){
            if($r->status_admin == 1){
                $resArr['all'][] = $r;
            }
            if($this->user_now()->id == $r->id_user){
                $resArr['for_user'][] = $r;
            }
        }

        return $resArr;
    }

    public function editLinkUser($id){
        $results = \DB::table('link_users')->where('id',$id)->first();

        return view('page.edit-link-user-view',[
            'data' => $results,
            'admin' => $this->admin(),
            'linkUser' => $this->LinkUser()
        ]);
    }

    public function editAddLinkUser(Request $request){

        if(!isset($request->status_admin)){
            $request->status_admin = 0;
        }

        \DB::table('link_users')->where('id', $request->id)
            ->update(array(
                'name' => $request->name,
                'link' => $request->link,
                'position' => $request->position,
                'status_admin' => $request->status_admin,
                'id_user' => $request->id_user
            ));
        return redirect()->intended('/');
    }

    public function deliteLinkUser(Request $request){
        \DB::table('link_users')->where('id', '=', $request->id)->delete();
        return redirect()->intended('/');
    }





}
