<?php

namespace App\Http\Controllers;

use App\Http\Requests\PremiumChargeRequest;
use Illuminate\Http\Request;
use App\Models\PremiumCharge;
use Response;
use Auth;
use Log;

class PremiumChargeController extends Controller
{
    /**
     * Method to show listing of resource
     * @return View
     */
    public function index($doctor_id = 0)
    {
        try {
            $data['doctor_id'] = $doctor_id;
            $data['premium_charge'] = PremiumCharge::where('doctor_id', $doctor_id)->first();
            $data['active'] = 'doctors';
            return view('Premium-charge.index', $data);
        } catch(\Exception $e) {
            Log::error("Error in index on PremiumChargeController ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Method to update resource
     * @param App\Http\Requests\PremiumChargeRequest $request
     * @return redirect
     */
    public function update(PremiumChargeRequest $request, $doctor_id = 0)
    {
        try {
            $premium_charge = PremiumCharge::where('doctor_id', $doctor_id)->first();
            if(!$premium_charge) {
                $premium_charge = new PremiumCharge();
                $premium_charge->doctor_id = $doctor_id;
            }
            $premium_charge->amount = $request->amount;
            $premium_charge->no_of_patient = $request->no_of_patient;
            $premium_charge->premium_patient = $request->premium_patient;
            if($premium_charge->save()) {
                return redirect()->back()->with('message', 'Premium charge updated successfully');
            }
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        } catch(\Exception $e) {
            Log::error("Error in update on PremiumChargeController ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Method to delete specified resource
     * @param int $doctor_id
     * return redirect
     */
    public function delete($doctor_id = 0)
    {
        try {
            $premium_charge = PremiumCharge::where('doctor_id', $doctor_id)->first();
            if(!$premium_charge) {
                return redirect()->back()->with('error', 'Oops! Premium charge not found.');
            }
            
            if($premium_charge->delete()) {
                return redirect()->back()->with('message', 'Premium charge removed successfully');
            }
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        } catch(\Exception $e) {
            Log::error("Error in update on PremiumChargeController ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }
}
