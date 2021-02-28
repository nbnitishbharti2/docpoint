<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Speciality;
use App\Models\Reason;
use App\Models\Country;
use App\Models\Doctor;
use DateInterval;
use DatePeriod;
use DateTime;
use Auth;
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
            $data['doc_count'] = count($docData);
            $data['total_appointment_count'] = Appointment::where('status', 'Approved')->orWhere('status', 'Active')->count();
            $data['total_patient_count'] = Appointment::where('status', 'Approved')->count();
            $data['appointments'] = Appointment::with('doctors', 'user', 'appointment_slot', 'reason')->get();
            $data['recent_doctors'] = Doctor::orderBy('id','desc')->take(5)->get();
            $data['recent_patients'] = Appointment::where('status', 'Approved')->orderBy('id','desc')->take(5)->get();
            $data['active'] = "dashboard";
            if (Auth::user()->doctors) {
                // /where('appointment_date', now())->
                $data['appointments'] = Appointment::where('doctor_id', Auth::user()->doctors->id)->with('user', 'appointment_slot', 'reason')->get();
                $data['patient_count'] = Appointment::where('doctor_id', Auth::user()->doctors->id)->where('status', 'Approved')->count();
                return view('Doctor.dashboard', $data);
            } else {
                $monday = strtotime("last monday");
                $monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
                $sunday = strtotime(date("Y-m-d",$monday)." +7 days");
                $this_week_sd = date("Y-m-d",$monday);
                $this_week_ed = date("Y-m-d",$sunday);
                //echo "Current week range from $this_week_sd to $this_week_ed ";
                

                $begin = new DateTime($this_week_sd);
                $end = new DateTime($this_week_ed);

                $interval = DateInterval::createFromDateString('1 day');
                $period = new DatePeriod($begin, $interval, $end);

                foreach ($period as $dt) {
                    //dd($dt->format("d-m-Y"));
                    $doctor = Doctor::whereDate('created_at', $dt->format("d-m-Y"))->count();
                    $patient = Appointment::where('status', 'Approved')->where('appointment_date', $dt->format("d-m-Y"))->count();
                    $data['doctor_patient'][] = [
                        'date' => $dt->format("Y-m-d"),
                        'doctor' => $doctor,
                        'patient' => $patient,
                    ];
                }
                $data['doctor_patient'] = json_encode($data['doctor_patient']);
                //dd($data['doctor_patient']);
                return view('dashboard', $data);
            }
        } catch(\Exception $e) {
            Log::error("Error in dashboard on HomeController ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }
}
