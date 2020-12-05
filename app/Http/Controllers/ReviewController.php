<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Response;
use Log;

class ReviewController extends Controller
{
    //
    public function index()
    {
    	$data=Review::orderBy('id','desc')->get();
    	return view('review.index',['data' => $data]);
    }
    public function changeStatus($id, $newstatus)
    {
    	try{
    		$data=Review::find($id);
    		$data->status=$newstatus;
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
}
