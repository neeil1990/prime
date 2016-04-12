<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;



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



    public function index()
    {
        return view('index');
    }



    public function personal(User $user){

       $users = $user->getUser(Auth::user()->id);
        return view('page.personal',['users' => $users]);

    }



    public function createPersonalForm()
    {

        return view('page.create_personal');
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

    public function edit(Request $request,$id){

        $user = User::where('id', $id)->first();
        return view('page.edit_personal',['user' => $user]);
    }


    public function update(Request $request,User $updateUser){
        $users = $request->all();
        $updateUser->UpdateUser($users);
        return redirect()->intended('personal');
    }





}
