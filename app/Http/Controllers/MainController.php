<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11.04.2016
 * Time: 15:41
 */

namespace App\Http\Controllers;


class MainController extends Controller
{

    public function Index(){
        return view('index');
    }


}