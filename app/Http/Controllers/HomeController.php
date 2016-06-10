<?php

namespace App\Http\Controllers;
use App\Groups;
use App\PassContext;
use App\PassDev;
use App\ProjectContext;
use App\ProjectSeo;
use App\ServiceAndPass;
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





    }

    public function user_now(){
        $users_now = User::where('id', Auth::user()->id)->first();
        return $users_now;
    }

    public function admin(){
        $users = User::whereRaw('id = ? and admin = 1', [$this->user_now()->id])->count();
        return $users;
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


    public function index()
    {


        return view('index',[
            'users_now' => $this->user_now(),
            'admin' => $this->admin()
        ]);
    }


    //Настройка полей для проектов сео
    public function settingFieldSeo(){

       $arrSettingFieldSeo = \DB::table('setting_fields')->where('table_value','seo')->get();
        return view('page.setting_field_seo',[
            'settings_sield' => $arrSettingFieldSeo,
            'admin' => $this->admin()
        ]);

    }

    //Настройка полей для проектов context
    public function settingFieldContext(){

        $arrSettingFieldContext = \DB::table('setting_fields')->where('table_value','context')->get();
        return view('page.setting_field_context',[
            'settings_sield' => $arrSettingFieldContext,
            'admin' => $this->admin()
        ]);

    }

    //Настройка полей для passSeo
    public function settingFieldPassSeo(){

        $arrSettingFieldContext = \DB::table('setting_fields')->where('table_value','pass_seo')->get();
        return view('page.setting_field_pass_seo',[
            'settings_sield' => $arrSettingFieldContext,
            'admin' => $this->admin()
        ]);
    }

    //Настройка полей для passDev
    public function settingFieldPassDev(){

        $arrSettingFieldContext = \DB::table('setting_fields')->where('table_value','pass_dev')->get();
        return view('page.setting_field_pass_dev',[
            'settings_sield' => $arrSettingFieldContext,
            'admin' => $this->admin()
        ]);
    }

    //Настройка полей для passContext
    public function settingFieldPassContext(){

        $arrSettingFieldContext = \DB::table('setting_fields')->where('table_value','pass_context')->get();
        return view('page.setting_field_pass_context',[
            'settings_sield' => $arrSettingFieldContext,
            'admin' => $this->admin()
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
            ->where('sorts.id_type','4')//ProgectSeo
            ->get();

        $arrBudget = array();
        foreach($project_seo as $key=>$u){
            $difference = intval(abs(
                strtotime($u->start) - strtotime($u->end)
            ));
            $project_seo[$key]->interval_date = $difference / (3600 * 24);

            $project_seo[$key]->value_serialize = unserialize($u->value_serialize);

            $arrBudget['budget'][] = $u->budget;
            $arrBudget['osvoeno'][] = $u->osvoeno;

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




    public function personal(User $user,Groups $groups){

       $user_groups = \DB::table('groups')->orderBy('positions')->get();
       $users = $user->getUser(Auth::user()->id);

        $arrItog = array();
        foreach($users as $key => $us) {

            $project_context_itog = \DB::table('sorts')
                ->leftJoin('project_contexts','sorts.id_table','=','project_contexts.id')
                ->where('sorts.id_user',$us->id)
                ->where('sorts.id_type','5')//ProgectContext
                ->get();

            $arrContextItog = array();
            foreach($project_context_itog as $itog){
                $arrContextItog[] = ($itog->ya_direct+$itog->go_advords)*$itog->procent_seo/100;
            }

            $users[$key]->procent_context_itog = array_sum($arrContextItog);

            $users[$key]->itog = $us->sum_many_first+array_sum($arrContextItog);
            $arrItog[] = $us->sum_many_first+array_sum($arrContextItog);


            $project_seos = \DB::table('project_seos')->where('id_glavn_user',$us->id)->count();
            $project_contexts = \DB::table('project_contexts')->where('id_glavn_user',$us->id)->count();

            $users[$key]->project_seos_count = $project_seos;
            $users[$key]->project_contexts_count = $project_contexts;
        }
        
        return view('page.personal',[
            'itog_sum' =>  array_sum($arrItog),
            'count_user' => count($users),
            'users' => $users,
            'user_groups' => $user_groups,
            'users_now' => $this->user_now(),
            'admin' => $this->admin()
        ]);
    }



    public function createPersonalForm(Groups $groups)
    {
        $group = $groups->all();
        return view('page.create_personal',[
            'users_now' => $this->user_now(),
            'groups' => $group,
            'admin' => $this->admin()
        ]);
    }

    public function create(Request $request){

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
        User::create([
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
            User::whereRaw('id = ?', [$del])->delete();
        }
        return $request['arr'];
    }

    public function delitePassSeo(Request $request){
        $delite = explode(',',$request['arr']);
        foreach($delite as $del){
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


    public function passSEO(PassSeo $passSeo){

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

        foreach($users as $key=>$u){
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
            'users_now' => $this->user_now(),
            'admin' => $this->admin(),
            'setting_field' => $setting_field
        ]);
    }

    public function passSeoCreatForm(){

        $user = User::all();
        return view('page.create_pass_seo',[
            'users' => $user ,
            'users_now' => $this->user_now(),
            'admin' => $this->admin()
        ]);
    }


    public function createPassSeo(Request $request){

        $this->validate($request,[
            'name_project' => 'required',
            'id_user' => 'required'
        ]);

      $add = PassSeo::create([
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
            'admin' => $this->admin()
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
    public function passContext(PassContext $passContext){

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

        foreach($users as $key=>$u){
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
            'users_now' => $this->user_now(),
            'admin' => $this->admin()
        ]);

    }

    public function passContextCreatsForm(){
        $user = User::all();
        return view('page.create_pass_context',[
            'users' => $user ,
            'users_now' => $this->user_now(),
            'admin' => $this->admin()
        ]);
    }

    public function createPassContext(Request $request){

        $this->validate($request,[
            'name_project' => 'required',
            'id_user' => 'required'
        ]);

       $add = PassContext::create([
            'name_project' => $request['name_project'],
            'id_glavn_user' => $request['id_glavn_user'],
            'loginYandex' => $request['loginYandex'],
            'passYandex' => $request['passYandex'],
            'loginGoogle' => $request['loginGoogle'],
            'passGoogle' => $request['passGoogle'],
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

    public function passDev(PassDev $passDev){

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

        foreach($users as $key=>$u){
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
            'users_now' => $this->user_now(),
            'admin' => $this->admin()
        ]);
    }

    public function passDevCreatForm(){

        $user = User::all();
        return view('page.create_pass_dev',[
            'users' => $user ,
            'admin' => $this->admin(),
            'users_now' => $this->user_now()
        ]);

    }

    public function createPassDev(Request $request){

        $this->validate($request,[
        'name_project' => 'required',
        'id_user' => 'required'
        ]);

        $add = PassDev::create([
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
            PassDev::whereRaw('id = ?', [$del])->delete();
        }
        return $request['arr'];
    }





    //График работы
    public function WorkGraff(){
        return view('page.work-grafik');
    }


    //Проекты сео

    public function projectSeo(){

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
        foreach($users as $key=>$u){

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

            $arrBudget['budget'][] = $u->budget;
            $arrBudget['osvoeno'][] = $u->osvoeno;

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


        return view('page.project-seo',[
            'budget_seo_osvoeno' => $arrBudget,
            'count_seo_prodject' => count($users),
            'users' => $users,
            'name' => $name,
            'users_now' => $this->user_now(),
            'admin' => $this->admin(),
            'setting_field' => $setting_field
        ]);
    }

    public function projectSeoCreateForm(){
        $user = User::all();
       return view('page.project-seo-crate-form',[
           'users' => $user,
           'admin' => $this->admin()
       ]);
    }

    public function createProjectSeo(Request $request){

        $this->validate($request, [
            'name_project' => 'required',
            'id_glavn_user' => 'required',
            'id_user' => 'required',
        ]);


        $add = ProjectSeo::create([
            'name_project' => $request['name_project'],
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


    public function getBalanseYandex(){

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

    }



    //Проекты context

    public function projectContext(){

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
            $sum = $u->ya_direct+$u->go_advords;
            $users[$key]->sum_zp = $sum*$u->procent_seo/100;

            $arrBuget[] = $u->ya_direct;
            $arrBuget[] = $u->go_advords;

            $users[$key]->value_serialize = unserialize($u->value_serialize);
        }
        $name = \DB::table('sorts')
            ->leftJoin('users','sorts.id_user','=','users.id')
            ->leftJoin('project_contexts','sorts.id_table','=','project_contexts.id')
            ->where('sorts.id_type','5')->get();

        //dd();

        return view('page.project-context',[
            'budget_context_project' => array_sum($arrBuget),
            'count_context_project' => count($users),
            'users' => $users,
            'name' => $name,
            'users_now' => $this->user_now(),
            'admin' => $this->admin(),
            'setting_field' => $setting_field
        ]);
    }

    public function projectContextCreateForm(){
        $user = User::all();
        return view('page.project_context_create_form',[
            'users' => $user,
            'admin' => $this->admin()
        ]);
    }

    public function createProjectContext(Request $request){

        $this->validate($request, [
            'name_project' => 'required',
            'id_user' => 'required',
        ]);


        $add = ProjectContext::create([
            'id_glavn_user' => $request['id_glavn_user'],
            'name_project' => $request['name_project'],
            'ya_direct' => $request['ya_direct'],
            'go_advords' => $request['go_advords'],
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

    public function serviceAndPassword(){

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


        return view('page.service-and-password',[
            'admin' => $this->admin(),
            'setting_field' => $setting_field,
            'name' => $name,
            'users' => $users
        ]);

    }

    public function serviceAndPasswordCreateForm(){
        $user = User::all();
        return view('page.service-and-password-create-form',[
            'admin' => $this->admin(),
            'users' => $user
        ]);
    }

    public function createServiceAndPassword(Request $request){

        $this->validate($request, [
            'name_project' => 'required',
            'id_user' => 'required',
        ]);


        $add = ServiceAndPass::create([
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
            'admin' => $this->admin()
        ]);
    }


}
