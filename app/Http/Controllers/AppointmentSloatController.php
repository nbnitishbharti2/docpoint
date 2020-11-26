<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppointmentSlots;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AppoinmentSloat;
use Response;
use Log;
class AppointmentSloatController extends Controller
{
    //
    public function index()
    {
    	//dd(Auth::user());
    	$data=AppointmentSlots::where('doctor_id',Auth::user()->id)->get();
    	return view('AppointmentSlots.index',['data' => $data]);
    }
     public function delete(int $city_id = 0)
    {
        try {
            $appoinment = AppointmentSlots::find($city_id);
            if($appoinment == null) { // If details not found then return
                return redirect()->back()->with('error', 'Details not found');
            }
            $appoinment->delete();
            return redirect()->back()->with('error', 'Record deleted successfully');
        } catch(\Exception $e) {
            Log::error("Error in delete on AppointmentSlotsController ". $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }
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
    public function edit(int $city_id = 0)
    {
        try {
            $data = AppointmentSlots::find($city_id);
            if($data == null) { // If details not found then return
                return redirect()->back()->with('error', 'Details not found');
            }
            return view('AppointmentSlots.edit',['data' => $data]); 
        } catch(\Exception $e) {
            Log::error("Error in edit on AppointmentSlots ". $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }
    public function update(AppoinmentSloat $request, $id = 0)
    { 

        try {
            $data = AppointmentSlots::find($id);
            $data->slot_time=$request->slot_time; 
            if($data == null) { // If details not found then return
                return redirect()->back()->with('error', 'Details not found');
            }
            if($data->save()){
               return redirect('appointment-slots')->with('message', 'Record Updated successfully');
            }
             return redirect()->back()->with('error', 'Record Not Updated successfully');
        } catch(\Exception $e) {
            Log::error("Error in update on AppointmentSlots ". $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }
    public function add()
    { 

        
             return view('AppointmentSlots.add'); 
             
    }
    public function store(AppoinmentSloat $request)
    { 

        try {
            $data = new AppointmentSlots();
            $data->slot_time=$request->slot_time;
            $data->doctor_id=Auth::user()->id;  
            if($data->save()){
               return redirect('appointment-slots')->with('message', 'Record Added successfully');
            }
             return redirect()->back()->with('error', 'Record Not Added successfully');
        } catch(\Exception $e) {
            Log::error("Error in Store on AppointmentSlots ". $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }
}
