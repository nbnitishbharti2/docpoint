<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('frontend.index');
    }
    /**
     * dashboard page
     * @param void
     * @author Chetan Jha
     * 
     */

    public function dashboard(){
        $data = array();
        $docData = DB::table('doctors')->get();
        $data['doc-count'] = count($docData);
        return view('dashboard',['data' => $data]);

    }
}
