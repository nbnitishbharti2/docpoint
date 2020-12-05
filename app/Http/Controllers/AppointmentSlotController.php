<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppointmentSlots;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AppoinmentSlot;
use App\Models\DoctorHoliday;
use App\Helpers\CommanHelper;
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
     * Method to show view to add resource
     * 
     * @return View
     */
    public function add()
    {
        try {
            $data['doctor_id'] = Auth::user()->doctors->id;
            return view('AppointmentSlots.add', $data); 
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
            $leaves = DoctorHoliday::where('doctor_id', Auth::user()->doctors->id)->pluck('date')->toArray();
            $days = isset($request->days) ? $request->days : array();
            $start_date = $request->start_date . ' ' . $request->start_time;
            $end_date = $request->end_date . ' ' . $request->end_time;
            //Calling the function
            $Data = CommanHelper::SplitTime($start_date, $end_date, $request->start_time, $request->end_time, $request->interval, $leaves, $days);
            
            foreach ($Data as $value) {
                // Implement unique check
                $check = AppointmentSlots::where(['doctor_id' => Auth::user()->doctors->id, 'slot_date_time' => date("Y-m-d H:i:s", strtotime($value))])->get();
                if($check->count() == 0) {
                    $slot_data = [
                        'doctor_id' => Auth::user()->doctors->id,
                        'slot_date' => date("Y-m-d", strtotime($value)),
                        'slot_date_time' => date("Y-m-d H:i:s", strtotime($value)),
                        'slot_time' => date("H:i:s", strtotime($value)),
                        'status' => 'Available'
                    ];
                    AppointmentSlots::create($slot_data);
                }
            }
            return redirect()->back()->with('error', 'Record Added successfully');
        } catch(\Exception $e) {
            Log::error("Error in Store on AppointmentSlots ". $e->getMessage());
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
}
