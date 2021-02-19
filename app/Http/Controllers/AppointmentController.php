<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Response;
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
            $data['appointments'] = Appointment::where('doctor_id', Auth::user()->doctors->id)->with('user', 'appointment_slot', 'reason')->get();
            $data['active'] = 'manage_appointment';
            return view('appointments.index', $data);
        } catch(\Exception $e) {
            Log::error("Error in index on AppointmentController ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Method to approve appointment
     * @param int $appointment_id
     * @return redirect
     */
    public function approveAppointment($appointment_id = 0)
    {
        try {
            $appoinment = Appointment::find($appointment_id);
            if($appoinment != null) {
                $appoinment->status = 'Approved';
                $appoinment->save();
                return redirect()->back()->with('message', 'Status Updated Successfully');
            }
            return redirect()->back()->with('message', 'Oops! Something went wrong');
        } catch(\Exception $e) {
            Log::error("Error in approveAppointment on AppointmentSlotsController ". $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }

    /**
     * Method to reject appointment
     * @param int $appointment_id
     * @return redirect
     */
    public function rejectAppointment($appointment_id = 0)
    {
        try {
            $appoinment = Appointment::find($appointment_id);
            if($appoinment != null) {
                $appoinment->status = 'Rejected';
                $appoinment->save();
                return redirect()->back()->with('message', 'Status Updated Successfully');
            }
            return redirect()->back()->with('message', 'Oops! Something went wrong');
        } catch(\Exception $e) {
            Log::error("Error in rejectAppointment on AppointmentSlotsController ". $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }
}
