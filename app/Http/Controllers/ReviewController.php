<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Response;
use Auth;
use Log;

class ReviewController extends Controller
{
    /**
     * Method to show reviews for doctor
     */
    public function index($doctor_id = 0)
    {
        $doctor_id = ($doctor_id == 0) ? Auth::user()->doctors->id : $doctor_id;
        $data = Review::where('doctor_id', $doctor_id)->orderBy('id','desc')->get();
    	return view('review.index',['data' => $data]);
    }

    public function changeStatus($id = 0, $newstatus = null)
    {
    	try{
    		$data = Review::find($id);
    		$data->status = $newstatus;
    		 if($data == null) { // If details not found then return
                return redirect()->back()->with('error', 'Details not found');
            }
            if($data->save()){ 
               return redirect()->back()->with('message', 'Review Updated successfully');
            }
             return redirect()->back()->with('error', 'Review Not Updated successfully');
    	} catch(\Exception $e) {
            Log::error("Error in changeStatus on ReviewController ". $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }


    public function addReview(Request $request)
    {
        try {
            $data = array(
                'user_id' => Auth::user()->id,
                'doctor_id' => $request->doctor_id,
                'wating_rate' => $request->wait_rating_count??1,
                'rate' => $request->bedside_rating_count??1,
                'review_desc' => $request->review??'', 
                'status' => 'New',
            );
            if (Review::create($data)) {
                return back()->with('message', 'Appointment boocked successfully');
            }
            return back()->with('error', 'Oops! Something went wrong.');
        } catch (\Exception $e) {
            Log::error("Error in addReview on DoctorController " . $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }
}
