<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReasonRequest;
use App\Models\Reason;
use App\Models\Speciality;
use Response;
use Log;
use Auth;
use Illuminate\Support\Facades\DB;

/**
 * DoctorCotroller responsible for all logical handeling of modules directly related to reason.

 * @author Chetan Jha
 */

class ReasonController extends Controller
{
    /**
     * Method to show listings of doctor
     * 
     * @return array $data
     */
    public function index()
    {
        try {
            $data['reasons'] = Reason::with('speciality')->orderBy('id', 'desc')->get();
            $data['active'] = 'reasons';
            return view('reason.index', $data);
        } catch (\Exception $e) {
            Log::error("Error in store on ReasonController" . $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Method to show form for add doctor
     * 
     * @return array $data
     */
    public function add()
    {
        try {
            $data['active'] = 'reasons';
            return view('reason.add', $data);
        } catch (\Exception $e) {
            Log::error("Error in store on ReasonController" . $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Method to store doctors data
     * @param App\Http\Requests\DoctorRequest $request
     * @return redirect
     */
    public function store(ReasonRequest $request)
    {
        try {
            $validated= $request->validated();
            // dd($validated);
            //$input = $request->except('_token');

            Reason::create(
                array(
                    'speciality_id' => $validated['speciality_id'],
                    'name' => $validated['name'],
                    'status' => $validated['status'],
                )
            );

            return redirect()->route('reason.index')->with('message', 'Reason added successfully');
        } catch (\Exception $e) {
            Log::error("Error in store on ReasonController " . $e->getMessage() .' '. $e->getLine());
            return back()->withInput()->with('error', 'Oops! Something went wrong.');
        }
    }

    
    public function changeStatus(Request $request)
    {
        try {
            $reason = Reason::find($request->reason_id);
            if ($reason == null) { // If details not found then return
                return redirect('reason-list')->with('error', 'Details not found');
            }
            $reason->status = ($request->status == "New") ? 'New' : 'Active';
            $reason->save();
            return Response::json(array('status' => true, 'msg' => 'Status changed successfully.'));
        } catch (\Exception $e) {
            Log::error("Error in changeStatus on ReasonController " . $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }
  
}
