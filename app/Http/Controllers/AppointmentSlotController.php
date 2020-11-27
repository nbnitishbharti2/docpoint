<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppointmentSlots;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AppoinmentSlot;
use Response;
use Log;

class AppointmentSlotController extends Controller
{
    /**
     * Method to show listing of resource
     * @return View
     */
    public function index()
    {
        try {
            $data = AppointmentSlots::where('doctor_id', Auth::user()->id)->get();
            return view('AppointmentSlots.index', ['data' => $data]);
        } catch(\Exception $e) {
            Log::error("Error in index on AppointmentSlotsController ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }
    
    /**
     * Method to delete resource
     * @param int $appointment_id
     * @return Redirect
     */
    public function delete(int $appointment_id = 0)
    {
        try {
            $appoinment = AppointmentSlots::find($appointment_id);
            if($appoinment == null) { // If details not found then return
                return redirect()->back()->with('error', 'Details not found');
            }
            $appoinment->delete();
            return redirect()->back()->with('error', 'Record deleted successfully');
        } catch(\Exception $e) {
            Log::error("Error in delete on AppointmentSlotsController ". $e->getMessage());
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
            $appoinment = AppointmentSlots::find($request->user_id);
            if($appoinment != null) {
                $appoinment->active = ($request->status == "active") ? 1 : 0;
                $appoinment->save();
                return Response::json(array('status' => true, 'msg' => 'Status changed successfully.'));
            }
            return Response::json(array('status' => false, 'msg' => 'City not found.'));
        } catch(\Exception $e) {
            Log::error("Error in changeStatus on AppointmentSlotsController ". $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }

    /**
     * Method to fetch details of resource for edit
     * @param int $appointment_id
     * @return View
     */
    public function edit(int $appointment_id = 0)
    {
        try {
            $data = AppointmentSlots::find($appointment_id);
            if($data == null) { // If details not found then return
                return redirect()->back()->with('error', 'Details not found');
            }
            return view('AppointmentSlots.edit', ['data' => $data]); 
        } catch(\Exception $e) {
            Log::error("Error in edit on AppointmentSlots ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Method to update resource
     * @param App\Http\Requests\AppoinmentSlot $request
     * @param int $id
     * @return Redirect
     */
    public function update(AppoinmentSlot $request, $id = 0)
    {
        try {
            $data = AppointmentSlots::find($id);
            $data->slot_time = $request->slot_time; 
            if($data == null) { // If details not found then return
                return redirect()->back()->with('error', 'Details not found');
            }
            if($data->save()) {
               return redirect('appointment-slots')->with('message', 'Record Updated successfully');
            }
            return redirect()->back()->with('error', 'Record Not Updated successfully');
        } catch(\Exception $e) {
            Log::error("Error in update on AppointmentSlots ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Method to show view to add resource
     * 
     * @return View
     */
    public function add()
    {
        try {
            return view('AppointmentSlots.add'); 
        } catch(\Exception $e) {
            Log::error("Error in add on AppointmentSlots ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Method to store resource
     * @param App\Http\Requests\AppoinmentSlot $request
     * @return Redirect
     */
    public function store(AppoinmentSlot $request)
    {
        try {
            $data = new AppointmentSlots();
            $data->slot_time = $request->slot_time;
            $data->doctor_id = Auth::user()->id;  
            if($data->save()){
               return redirect('appointment-slots')->with('message', 'Record Added successfully');
            }
            return redirect()->back()->with('error', 'Record Not Added successfully');
        } catch(\Exception $e) {
            Log::error("Error in Store on AppointmentSlots ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }
}
