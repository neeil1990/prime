<?php

namespace App\Http\Controllers;
use App\Groups;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\PassContext;





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


    public function index()
    {
        return view('index',['users_now' => $this->user_now()]);
    }



    public function personal(User $user,Groups $groups){
       $user_groups = $groups->getUserGroups(Auth::user()->id);
       $users = $user->getUser(Auth::user()->id);
        return view('page.personal',['users' => $users,'user_groups' => $user_groups, 'users_now' => $this->user_now(),'admin' => $this->admin()]);
    }



    public function createPersonalForm()
    {

        return view('page.create_personal',['users_now' => $this->user_now()]);
    }

    public function create(Request $request){

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request['name'],
            'specialism' => $request['specialism'],
            'level' => $request['level'],
            'personal_specialism' => $request['personal_specialism'],
            'seo_procent' => $request['seo_procent'],
            'sum_many_first' => $request['sum_many_first'],
            'contecst_procent' => $request['contecst_procent'],
            'sum_many_last' => $request['sum_many_last'],
            'itog' => $request['itog'],
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

    public function delitePassContext(Request $request){
        $delite = explode(',',$request['arr']);
        foreach($delite as $del){
            PassContext::whereRaw('id = ?', [$del])->delete();
        }
        return $request['arr'];
    }

    public function edit(Request $request,$id){

        $user = User::where('id', $id)->first();
        return view('page.edit_personal',['user' => $user],['users_now' => $this->user_now()]);
    }

    public function editPassContext($id){
        $user_all = User::all();
        $users = \DB::table('users')->join('pass_contexts','users.id','=','pass_contexts.id_user')->where('pass_contexts.id',$id)->first();
        return view('page.edit_pass_context',['users' => $users,'user_all' => $user_all],['users_now' => $this->user_now()]);
    }


    public function update(Request $request,User $updateUser){
        $users = $request->all();
        $updateUser->UpdateUser($users);
        return redirect()->intended('personal');
    }

    public function updatePassContext(Request $request,PassContext $passContext){
        $users_pass_context = $request->all();
        $passContext->UpdatePassContextUser($users_pass_context);
        return redirect()->intended('pass-context');
    }


    public function passContext(PassContext $passContext){
        $users =$passContext->getUserPassContext(Auth::user()->id);
        return view('page.pass_context',['users' => $users,'users_now' => $this->user_now(),'admin' => $this->admin()]);
    }

    public function passContextCreatForm(){

        $user = User::all();
        return view('page.create_pass_context',['users' => $user ,'users_now' => $this->user_now()]);
    }


    public function createPassContext(Request $request){

        PassContext::create([
            'name_project' => $request['name_project'],
            'id_user' => $request['id_user'],
            'ssa' => $request['ssa'],
            'ftp' => $request['ftp'],
            'login' => $request['login'],
            'password' => $request['password']
        ]);

        return redirect()->intended('/pass-context');
    }


    public function createGroupForm(){
        $user = User::all();
        return view('page.create_group_form',['users' => $user],['users_now' => $this->user_now()]);
    }

    public function createGroups(Request $request){
        Groups::create([
            'id_user' => $request['id_user'],
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
        $users = \DB::table('users')->join('groups','users.id','=','groups.id_user')->where('groups.id',$id)->first();
        return view('page.edit_groups',['users' => $users,'users_all' => $user_all],['users_now' => $this->user_now()]);
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



}
