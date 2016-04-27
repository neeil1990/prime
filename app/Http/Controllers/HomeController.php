<?php

namespace App\Http\Controllers;
use App\Groups;
use App\PassContext;
use App\PassDev;
use App\ProjectContext;
use App\ProjectSeo;
use App\Sort;
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

    public function showProcentGroup(Request $request){

        $procent = \DB::table('groups')
            ->where('specialnost',$request['arr1'])
            ->where('level',$request['arr2'])
            ->get();


       return json_encode($procent[0]);

    }

    public function showProcentUsers(Request $request){

        $procent = \DB::table('users')
            ->where('id',$request['arr1'])
            ->get();


        return json_encode($procent[0]);

    }


    public function index()
    {


        return view('index',['users_now' => $this->user_now()]);
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
        $arrUser = array();
        foreach($users as $u){
            $arrUser[] = $u->itog;
        }

        return view('page.personal',['itog_sum' => array_sum($arrUser), 'count_user' => count($users), 'users' => $users,'user_groups' => $user_groups, 'users_now' => $this->user_now(),'admin' => $this->admin()]);
    }



    public function createPersonalForm(Groups $groups)
    {
        $group = $groups->all();
        return view('page.create_personal',['users_now' => $this->user_now(),'groups' => $group]);
    }

    public function create(Request $request){

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $message = 'Личный кабинет: http://work.prime-ltd.su '.' Логин: '.$request['email'].' '.'Пароль: '.$request['password'];
        mail($request['email'], 'Личный кабинет PRIME', $message);

        User::create([
            'name' => $request['name'],
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
        return view('page.edit_personal',['user' => $user, 'users_now' => $this->user_now(),'groups' => $group]);
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

        return view('page.edit_pass_seo',[
            'users' => $pass_seo,
            'user_all' => $user_all,
            'user' => $user,
            'users_now' => $this->user_now()
        ]);
    }


    public function update(Request $request,User $updateUser){
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

        $users = User::whereRaw('id = ? and admin = 1', [Auth::user()->id])->count();
        if($users == 1){
            $users = \DB::table('pass_seos')->orderBy('positions')->get();
        }else{
            $users = \DB::table('sorts')
            ->leftJoin('users','sorts.id_user','=','users.id')
            ->leftJoin('pass_seos','sorts.id_table','=','pass_seos.id')
            ->where('sorts.id_type','1')
            ->where('users.id',Auth::user()->id)
            ->orderBy('pass_seos.positions')
            ->get();
        }
       // dd($users);
        $name = \DB::table('sorts')
            ->leftJoin('users','sorts.id_user','=','users.id')
            ->leftJoin('pass_seos','sorts.id_table','=','pass_seos.id')
            ->where('sorts.id_type','1')->get();



        return view('page.pass_seo',['users' => $users,'name' => $name,'users_now' => $this->user_now(),'admin' => $this->admin()]);
    }

    public function passSeoCreatForm(){

        $user = User::all();
        return view('page.create_pass_seo',['users' => $user ,'users_now' => $this->user_now()]);
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
            'login' => $request['login'],
            'password' => $request['password']
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
        return view('page.create_group_form',['users' => $user],['users_now' => $this->user_now()]);
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
        return view('page.edit_groups',['users' => $users,'users_all' => $user_all ,'users_now' => $this->user_now()]);
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

        $users = User::whereRaw('id = ? and admin = 1', [Auth::user()->id])->count();
        if($users == 1){
            $users = \DB::table('pass_contexts')->orderBy('positions')->get();
        }else{
            $users = \DB::table('sorts')
                ->leftJoin('users','sorts.id_user','=','users.id')
                ->leftJoin('pass_contexts','sorts.id_table','=','pass_contexts.id')
                ->where('sorts.id_type','2')
                ->where('users.id',Auth::user()->id)
                ->orderBy('pass_contexts.positions')
                ->get();
        }
        // dd($users);
        $name = \DB::table('sorts')
            ->leftJoin('users','sorts.id_user','=','users.id')
            ->leftJoin('pass_contexts','sorts.id_table','=','pass_contexts.id')
            ->where('sorts.id_type','2')->get();

        return view('page.pass_context',['users' => $users,'name' => $name, 'users_now' => $this->user_now(),'admin' => $this->admin()]);

    }

    public function passContextCreatsForm(){
        $user = User::all();
        return view('page.create_pass_context',['users' => $user ,'users_now' => $this->user_now()]);
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
            'passGoogle' => $request['passGoogle']
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


        return view('page.edit_pass_context',[
            'user' => $user,
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

        $users = User::whereRaw('id = ? and admin = 1', [Auth::user()->id])->count();
        if($users == 1){
            $users = \DB::table('pass_devs')->orderBy('positions')->get();
        }else{
            $users = \DB::table('sorts')
                ->leftJoin('users','sorts.id_user','=','users.id')
                ->leftJoin('pass_devs','sorts.id_table','=','pass_devs.id')
                ->where('sorts.id_type','3')
                ->where('users.id',Auth::user()->id)
                ->orderBy('pass_devs.positions')
                ->get();
        }
        // dd($users);
        $name = \DB::table('sorts')
            ->leftJoin('users','sorts.id_user','=','users.id')
            ->leftJoin('pass_devs','sorts.id_table','=','pass_devs.id')
            ->where('sorts.id_type','3')->get();



        return view('page.pass_dev',['users' => $users,'name' => $name,'users_now' => $this->user_now(),'admin' => $this->admin()]);
    }

    public function passDevCreatForm(){

        $user = User::all();
        return view('page.create_pass_dev',['users' => $user ,'users_now' => $this->user_now()]);

    }

    public function createPassDev(Request $request){

        $this->validate($request,[
        'name_project' => 'required',
        'id_user' => 'required'
        ]);

        $add = PassDev::create([
            'name_project' => $request['name_project'],
            'id_glavn_user' => $request['id_user_gl'],
            'ssa' => $request['ssa'],
            'ftp' => $request['ftp'],
            'login' => $request['login'],
            'password' => $request['password']
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

        return view('page.edit_pass_dev',[
            'users' => $pass_dev,
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

        $users = User::whereRaw('id = ? and admin = 1', [Auth::user()->id])->count();
        if($users == 1){
            $users = \DB::table('project_seos')->orderBy('positions')->get();
        }else{
            $users = \DB::table('sorts')
                ->leftJoin('users','sorts.id_user','=','users.id')
                ->leftJoin('project_seos','sorts.id_table','=','project_seos.id')
                ->where('sorts.id_type','4')
                ->where('users.id',Auth::user()->id)
                ->orderBy('project_seos.positions')
                ->get();
        }
        $arrBudget = array();
        foreach($users as $key=>$u){
            $difference = intval(abs(
                strtotime($u->start) - strtotime($u->end)
            ));
            $users[$key]->interval_date = $difference / (3600 * 24);

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


        return view('page.project-seo',['budget_seo_osvoeno' => $arrBudget, 'count_seo_prodject' => count($users),'users' => $users,'name' => $name,'users_now' => $this->user_now(),'admin' => $this->admin()]);
    }

    public function projectSeoCreateForm(){
        $user = User::all();
       return view('page.project-seo-crate-form',['users' => $user]);
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

    public function projectContext(){

        $users = User::whereRaw('id = ? and admin = 1', [Auth::user()->id])->count();
        if($users == 1){
            $users = \DB::table('project_contexts')->orderBy('positions')->get();
        }else{
            $users = \DB::table('sorts')
                ->leftJoin('users','sorts.id_user','=','users.id')
                ->leftJoin('project_contexts','sorts.id_table','=','project_contexts.id')
                ->where('sorts.id_type','5')
                ->where('users.id',Auth::user()->id)
                ->orderBy('project_contexts.positions')
                ->get();
        }

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

        return view('page.project-context',['budget_context_project' => array_sum($arrBuget), 'count_context_project' => count($users), 'users' => $users,'name' => $name,'users_now' => $this->user_now(),'admin' => $this->admin()]);
    }

    public function projectContextCreateForm(){
        $user = User::all();
        return view('page.project_context_create_form',['users' => $user]);
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



}
