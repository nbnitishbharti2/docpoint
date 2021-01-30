<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Speciality;
use App\Models\Reason;
use App\Models\Country;
use App\Models\Doctor;
use Log; 


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
        try { 
            $country = Country::get();
            $speciality = Speciality::get()->where('status', 'Active');
            $resion = Reason::orderBy('name','asc')->get();
            return view('frontend.index', ['country' => $country, 'speciality'=>$speciality, 'resion' => $resion]);
        } catch(\Exception $e) {
            Log::error("Error in index on HomeController ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * dashboard page
     * @param void
     * @author Chetan Jha
     * 
     */
    public function dashboard()
    {
        try {
            $docData = Doctor::get()->where('status', 'Active');
            $data['doc-count'] = count($docData);
            return view('dashboard', ['data' => $data, 'active' => 'dashboard']);
        } catch(\Exception $e) {
            Log::error("Error in dashboard on HomeController ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }
}
