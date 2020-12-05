<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Auth;
use Log;

class AppointmentController extends Controller
{
    /**
     * Method to get listing of resources
     */
    public function index()
    {
        try {
            $data['appointments'] = Appointment::where('doctor_id', Auth::user()->doctors->id)->get();
            return view('appointments.index', $data);
        } catch(\Exception $e) {
            Log::error("Error in index on AppointmentController ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }
}
