<?php

namespace App\Http\Controllers;

use App\Http\Requests\PremiumChargeRequest;
use Illuminate\Http\Request;
use App\Models\PremiumCharge;
use App\Models\DefaultCharge;
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

            //$premium_charge->amount = $request->amount;
            $premium_charge->no_of_patient = $request->no_of_patient;
            $premium_charge->premium_patient = $request->premium_patient;

            $premium_charge->physical_normal_charge = ($request->physical_normal_charge!=null)?$request->physical_normal_charge:0.00;
            
            $premium_charge->physical_normal_commission_cash = ($request->physical_normal_commission_cash!=null)?$request->physical_normal_commission_cash:0.00;
            $premium_charge->physical_normal_commission_online = ($request->physical_normal_commission_online!=null)?$request->physical_normal_commission_online:0.00;
            $premium_charge->physical_premium_charge = ($request->physical_premium_charge!=null)?$request->physical_premium_charge:0.00;
            $premium_charge->physical_premium_commission_cash = ($request->physical_premium_commission_cash!=null)?$request->physical_premium_commission_cash:0.00;
            $premium_charge->physical_premium_commission_online = ($request->physical_premium_commission_online!=null)?$request->physical_premium_commission_online:0.00;
            $premium_charge->video_normal_charge = ($request->video_normal_charge!=null)?$request->video_normal_charge:0.00;
            $premium_charge->video_normal_commission_cash = ($request->video_normal_commission_cash!=null)?$request->video_normal_commission_cash:0.00;
            $premium_charge->video_normal_commission_online = ($request->video_normal_commission_online!=null)?$request->video_normal_commission_online:0.00;
            $premium_charge->video_premium_charge = ($request->video_premium_charge!=null)?$request->video_premium_charge:0.00;
            $premium_charge->video_premium_commission_cash = ($request->video_premium_commission_cash!=null)?$request->video_premium_commission_cash:0.00;
            $premium_charge->video_premium_commission_online = ($request->video_premium_commission_online!=null)?$request->video_premium_commission_online:0.00;


           //  dd($request);
           
            $premium_charge->physical_normal_commission_cash_status = (isset($request->physical_normal_commission_cash_status))?1:0;
            $premium_charge->physical_normal_commission_online_status = (isset($request->physical_normal_commission_online_status))?1:0;
            $premium_charge->physical_premium_commission_cash_status = (isset($request->physical_premium_commission_cash_status))?1:0;
            $premium_charge->physical_premium_commission_online_status = (isset($request->physical_premium_commission_online_status))?1:0;
            $premium_charge->video_normal_commission_cash_status = (isset($request->video_normal_commission_cash_status))?1:0;
            $premium_charge->video_normal_commission_online_status = (isset($request->video_normal_commission_online_status))?1:0;
            $premium_charge->video_premium_commission_cash_status = (isset($request->video_premium_commission_cash_status))?1:0;
            $premium_charge->video_premium_commission_online_status = (isset($request->video_premium_commission_online_status))?1:0;

           
            if($premium_charge->save()) {
                return redirect()->back()->with('message', 'Premium charge updated successfully');
            }
             dd($premium_charge);
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
    public function default()
    {
        try {
            $data['active'] = 'default-charge'; 
            $data['premium_charge'] = DefaultCharge::first(); 
            return view('Premium-charge.default', $data);
        } catch(\Exception $e) {
            Log::error("Error in default on PremiumChargeController ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function updateDefault(Request $request)
    {

        try {
            $premium_charge = DefaultCharge::find(1);
            if(!$premium_charge) {
                $premium_charge = new DefaultCharge(); 
            } 

            $premium_charge->physical_normal_charge = ($request->physical_normal_charge!=null)?$request->physical_normal_charge:0.00;
            
            $premium_charge->physical_normal_commission_cash = ($request->physical_normal_commission_cash!=null)?$request->physical_normal_commission_cash:0.00;
            $premium_charge->physical_normal_commission_online = ($request->physical_normal_commission_online!=null)?$request->physical_normal_commission_online:0.00;
            $premium_charge->physical_premium_charge = ($request->physical_premium_charge!=null)?$request->physical_premium_charge:0.00;
            $premium_charge->physical_premium_commission_cash = ($request->physical_premium_commission_cash!=null)?$request->physical_premium_commission_cash:0.00;
            $premium_charge->physical_premium_commission_online = ($request->physical_premium_commission_online!=null)?$request->physical_premium_commission_online:0.00;
            $premium_charge->video_normal_charge = ($request->video_normal_charge!=null)?$request->video_normal_charge:0.00;
            $premium_charge->video_normal_commission_cash = ($request->video_normal_commission_cash!=null)?$request->video_normal_commission_cash:0.00;
            $premium_charge->video_normal_commission_online = ($request->video_normal_commission_online!=null)?$request->video_normal_commission_online:0.00;
            $premium_charge->video_premium_charge = ($request->video_premium_charge!=null)?$request->video_premium_charge:0.00;
            $premium_charge->video_premium_commission_cash = ($request->video_premium_commission_cash!=null)?$request->video_premium_commission_cash:0.00;
            $premium_charge->video_premium_commission_online = ($request->video_premium_commission_online!=null)?$request->video_premium_commission_online:0.00;


           //  dd($request);
           
            $premium_charge->physical_normal_commission_cash_status = (isset($request->physical_normal_commission_cash_status))?1:0;
            $premium_charge->physical_normal_commission_online_status = (isset($request->physical_normal_commission_online_status))?1:0;
            $premium_charge->physical_premium_commission_cash_status = (isset($request->physical_premium_commission_cash_status))?1:0;
            $premium_charge->physical_premium_commission_online_status = (isset($request->physical_premium_commission_online_status))?1:0;
            $premium_charge->video_normal_commission_cash_status = (isset($request->video_normal_commission_cash_status))?1:0;
            $premium_charge->video_normal_commission_online_status = (isset($request->video_normal_commission_online_status))?1:0;
            $premium_charge->video_premium_commission_cash_status = (isset($request->video_premium_commission_cash_status))?1:0;
            $premium_charge->video_premium_commission_online_status = (isset($request->video_premium_commission_online_status))?1:0;

          
            if($premium_charge->save()) { 
                return redirect()->back()->with('message', 'Dafault charge updated successfully');
            }
             
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        } catch(\Exception $e) {
            Log::error("Error in updateDefault on PremiumChargeController ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }
}
