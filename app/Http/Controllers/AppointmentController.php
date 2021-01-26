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
            return view('appointments.index', $data);
        } catch(\Exception $e) {
            Log::error("Error in index on AppointmentController ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Method to change status of resource
     * @param Illuminate\Http\Request $request
     * @return Response
     */
    public function changeStatus(Request $request)
    {
        try {
            $appoinment = Appointment::find($request->appointment_id);
            if($appoinment != null) {
                $appoinment->status = ($request->status == "Active") ? 'Active' : 'Rejected';
                $appoinment->save();
                return Response::json(array('status' => true, 'msg' => 'Status changed successfully.'));
            }
            return Response::json(array('status' => false, 'msg' => 'Appointment not found'));
        } catch(\Exception $e) {
            Log::error("Error in changeStatus on AppointmentSlotsController ". $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }
}
