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
    public function dashboard(Request $request)
    {
        try {
            $from_date=date("Y-m-d");
            $to_date=date("Y-m-d");
            $data['today']=1;
            if(isset($request->from)){
               $data['today']=0;
                $from_date=date("Y-m-d", strtotime($request->from)); 
            }
            if(isset($request->to)){
                $data['today']=0;
                $to_date=date("Y-m-d", strtotime($request->to));
            }
            $data['from']=date("d-m-Y", strtotime($from_date));
            $data['to']=date("d-m-Y", strtotime($to_date));
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
                $data['appointments'] = Appointment::where('doctor_id', Auth::user()->doctors->id)->with('user', 'appointment_slot', 'reason')->whereBetween('appointment_date', [$from_date, $to_date])->orderBy('id','desc')->take(15)->get();
                $data['patient_count'] = Appointment::where('doctor_id', Auth::user()->doctors->id)->where('status', 'Approved')->whereBetween('appointment_date', [$from_date, $to_date])->groupBy('user_id')->get();
                $data['patient_count_revenue'] = Appointment::where('doctor_id', Auth::user()->doctors->id)->where('status', 'Approved')->whereBetween('appointment_date', [$from_date, $to_date])->sum('appointment_slot_id'); 
                $data['patient_count_accepted'] = Appointment::where('doctor_id', Auth::user()->doctors->id)->where('status', 'Approved')->whereBetween('appointment_date', [$from_date, $to_date])->count();
                $data['patient_count_pending'] = Appointment::where('doctor_id', Auth::user()->doctors->id)->where('status', 'Active')->whereBetween('appointment_date', [$from_date, $to_date])->count();
                $data['patient_count_recected'] = Appointment::where('doctor_id', Auth::user()->doctors->id)->where('status', 'Rejected')->whereBetween('appointment_date', [$from_date, $to_date])->count();
                $data['patient_count']=count($data['patient_count']);

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
