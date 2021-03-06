<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Speciality;
use Validator;
use Response;
use Log;

class SpecialityController extends Controller 
{
    /**
     * Method to show listing of resource
     * @return view
     */
    public function index()
    {
        try {
            $data['data'] = Speciality::get();
            $data['active'] = 'speciality';
            return view('Speciality.index', $data);
        } catch(\Exception $e) {
            Log::error("Error in index on SpecialityController ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Method to show page for create resource
     * @param Illuminate\Http\Request $request
     */
    public function add()
    {
        try {
            $data['active'] = 'speciality';
            return view('Speciality.add', $data);
        } catch(\Exception $e) {
            Log::error("Error in add on SpecialityController ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }
    
    /**
     * Method to store resource
     * @param Illuminate\Http\Request $request
     * @return redirect
     */
    public function store(Request $request)
    {
        try {
            $input = $request->except('_token');
            
            //validation starts--
            $validator = Validator::make($request->all(), [
                    'pic' => 'required|mimes:png,jpg,jpeg|max:2048',
                    'spec_name'=>'required|unique:specialities',
                ], 
                [
                    'pic.required' => 'Image field is required.',
                    'pic.size' => 'Uploaded file not be greater than 2mb in size.',
            ]);
            if($validator->fails()) { // if validator fails
                return back()->withErrors($validator)->withInput();
            }
            
            if ($request->has('pic')) { // If file found then store
                $pic = $request->file('pic');
                $picName = time() . '.' . $pic->getClientOriginalExtension();
                $request->file('pic')->storeAs('public/images/specialities', $picName);
                $input['pic'] = $picName;
            }
            
            Speciality::create($input);
            return redirect('/speciality-index')->with('message', 'Speciality added successfully');
        } catch(\Exception $e) {
            Log::error("Error in store on SpecialityController ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Method to show resource for edit
     * @param int $specId
     * @return Collection $specialityDetails
     * @return int $specId
     */

    public function show(int $specId = 0)
    {
        try{
            $data['specialities'] = Speciality::find($specId);
            if($data['specialities'] == null) {
                return back()->with('error', 'Speciality details not found.');
            }
            $data['active'] = 'speciality';
            $data['id'] = $specId;
            return view('Speciality.edit', $data);
        } catch(\Exception $e) {
            Log::error("Error in show on SpecialityController ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Method to update resource
     * @param Illuminate\Http\Request $request
     * @param int $specId
     * @return redirect
     */
    public function edit(Request $request, $specId = 0)
    {
        try {
            $input = $request->except('_token');
            $specilityData = Speciality::find($specId);
            // validation starts--
            $validator = Validator::make($request->all(), [
                    'pic' => 'required|mimes:png,jpg,jpeg|max:2048',
                    'spec_name'=>'required|unique:specialities,spec_name,'.$specId,
                ], 
                [
                    'pic.required' => 'Image field is required.',
                    'pic.size' => 'Uploaded file not be greater than 2mb in size.',
            ]);
            
            if($validator->fails()) { // if validator fails
                return back()->withErrors($validator)->withInput();
            }
            
            if ($request->has('pic')) { // If file found then store
                $pic = $request->file('pic');
                $picName = time() . '.' . $pic->getClientOriginalExtension();
                $request->file('pic')->storeAs('public/images/specialities', $picName);
                $input['pic'] = $picName;
            }

            if($specilityData->pic != null && file_exists('storage/images/specialities/'.$specilityData->pic)) {
                unlink(storage_path('app/public/images/specialities/'.$specilityData->pic));
            }
            Speciality::where('id', $specId)->update($input);
            
            return redirect('/speciality-index')->with('message', 'Speciality edited successfully');
        } catch(\Exception $e) {
            Log::error("Error in edit on SpecialityController ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Method to change Speciality status
     * @param Illuminate\Http\Request $request
     * @return Response array
     * 
     */
    public function changeStatus(Request $request)
    {
        try {
            $speciality = Speciality::find($request->speciality_id);
            $speciality->status = ($request->status == "active") ? 'Active' : 'Inactive';
            $speciality->save();
            return Response::json(array('status' => true, 'msg' => 'Status changed successfully.'));
        } catch(\Exception $e) {
            Log::error("Error in changeStatus on SpecialityController ". $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }

    /**
     * Method to delete Speciality
     * @param int $speciality_id
     * @return redirect
     */
    public function delete(int $speciality_id = 0)
    {
        try {
            $speciality = Speciality::find($speciality_id);
            if($speciality == null) { // If details not found then return
                return redirect('speciality-index')->with('error', 'Details not found');
            }
            $speciality->delete();
            return redirect('speciality-index')->with('error', 'Record deleted successfully');
        } catch(\Exception $e) {
            Log::error("Error in delete on SpecialityController ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }
}
