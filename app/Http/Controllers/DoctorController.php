<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\DoctorRequest;
use App\Models\Doctor as Doctors;
use App\Helpers\CommanHelper;
use App\Models\Speciality;
use App\Models\Country;
use App\Models\Gender;
use App\Models\State;
use App\Models\City;
use App\Models\User;
use App\Models\Role;
use Response;
use Log;

/**
 * DoctorCotroller responsible for all logical handeling of modules directly related to doctor.
 * @author Chetan Jha
 */

class DoctorController extends Controller
{
    /**
     * Method to show listings of doctor
     * 
     * @return array $data
     */
    public function index()
    {
        try {
            $data['doctors'] = Doctors::with('speciality')->orderBy('id', 'desc')->get();
            return view('Doctor.index', $data);
        } catch(\Exception $e) {
            Log::error("Error in store on DoctorController ". $e->getMessage());
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
            $data['specialities'] = Speciality::get();
            $data['countries'] = Country::get();
            $data['genders'] = Gender::get();
            return view('Doctor.add', $data);
        } catch(\Exception $e) {
            Log::error("Error in store on DoctorController ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Method to store doctors data
     * @param App\Http\Requests\DoctorRequest $request
     * @return redirect
     */
    public function store(DoctorRequest $request)
    {
        try {
            $input = $request->except('_token');
            
            if ($request->has('pic')) { // If pic found
                $image      = $request->file('pic');
                $fileName   = time() . '.' . $image->getClientOriginalExtension();
                $request->file('pic')->storeAs('public/images/doctor', $fileName);
                $input['pic'] = $fileName;
            }
            
            $userData = array(
                'name' => $input['name'],
                'email' => $input['email'],
                'mobile' => $input['mobile'],
                'password' => Hash::make('12345678'),
                'status' => ($request->has('status')) ? 'Active' : 'Inactive',
                'pic' => $input['pic']??'',
                'created_at' => date("Y-m-d h:i:s"),
                'updated_at' => date("Y-m-d h:i:s"),
            );
            $user = User::create($userData);
            
            // Create data for insert in doctors table
            $doctorData = array(
                'user_id' => $user->id,
                'country_id' => $input['country'],
                'state_id' => $input['state'],
                'city_id' => $input['city'],
                'speciality_id' => $input['speciality'],
                'gender_id' => $input['gender'],
                'name' => $input['name'],
                'about' => $input['about'],
                'pic' => $input['pic']??'',
                'mobile' => $input['mobile'],
                'phone' => $input['phone'],
                'fax' => $input['fax'],
                'email' => $input['email'],
                'address' => $input['address'],
                'zip' => $input['zip'],
                'latitude' => $input['lat'],
                'longitude' => $input['long'],
                'website' => $input['website'],
                'status' => ($request->has('status')) ? 'Active' : 'Inactive',
            );
            Doctors::create($doctorData);
            // Attach role to user
            $doctor_role = Role::where('name', 'Doctor')->first();
            if($doctor_role != null) {
                CommanHelper::attachRole($user, $doctor_role); 
            }
            return redirect('doctor-list')->with('message', 'Details added successfully');
        } catch(\Exception $e) {
            Log::error("Error in store on DoctorController ". $e->getMessage());
            return back()->withInput()->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Method to show doctors data for edit
     * @param int $id
     * @return array $data
     */
    public function edit(int $id = 0)
    {
        try {
            $data['id'] = $id;
            $data['docDetails'] = Doctors::find($id);
            $data['specialities'] = Speciality::get();
            $data['genders'] = Gender::get();
            $data['countries'] = Country::get();
            $data['states'] = State::where('country_id', $data['docDetails']->country_id)->get();
            $data['cities'] = City::where('state_id', $data['docDetails']->state_id)->get();
            return view('Doctor.edit', $data);
        } catch(\Exception $e) {
            Log::error("Error in edit on DoctorController ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Method to update doctors data
     * @param App\Http\Requests\DoctorRequest $request
     * @param int $id
     * @return redirect
     */
    public function update(DoctorRequest $request, $id = 0)
    {
        try {
            $input = $request->all();
            $doctor = Doctors::find($id);
            if ($request->has('pic')) { //If picture found
                $image      = $request->file('pic');
                $fileName   = time() . '.' . $image->getClientOriginalExtension();
                $request->file('pic')->storeAs('public/images/doctor', $fileName);
                $input['pic'] = $fileName;
            }
            // Delete old image
            if($doctor->pic != null && file_exists('storage/images/doctor/'.$doctor->pic)) {
                unlink(storage_path('app/public/images/doctor/'.$doctor->pic));
            }

            $userData = array(
                'name' => $input['name'],
                'email' => $input['email'],
                'mobile' => $input['mobile'],
                'pic' => $input['pic']??'',
                'status' => ($request->has('status')) ? 'Active' : 'Inactive',
            );

            User::where('id', $doctor->user_id)->update($userData);

            $doctorData = array(
                'country_id' => $input['country'],
                'state_id' => $input['state'],
                'city_id' => $input['city'],
                'speciality_id' => $input['speciality'],
                'gender_id' => $input['gender'],
                'name' => $input['name'],
                'about' => $input['about'],
                'pic' => $input['pic']??'',
                'mobile' => $input['mobile'],
                'phone' => $input['phone'],
                'alt_moblie' => $input['alt_moblie'],
                'fax' => $input['fax'],
                'email' => $input['email'],
                'address' => $input['address'],
                'zip' => $input['zip'],
                'latitude' => $input['lat'],
                'longitude' => $input['long'],
                'website' => $input['website'],
                'status' => ($request->has('status')) ? 'Active' : 'Inactive',
            );

            Doctors::where('id', $id)->update($doctorData);
            
            return redirect('doctor-list')->with('message', 'Doctor details edited successfully');
        } catch(\Exception $e) {
            Log::error("Error in update on DoctorController ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Method to show profile
     * @param int $docId
     * @return array $data
     */
    public function myProfile(int $docId = 0)
    {
        try {
            $data['doctor'] = Doctors::find($docId);
            if($data['doctor'] == null) {
                return redirect('doctor-list')->with('error', 'Details not found');
            }
            return view('Doctor.profile', $data);
        } catch(\Exception $e) {
            Log::error("Error in myProfile on DoctorController ". $e->getMessage());
            Session::flash('alert-danger', 'Oops! Something went wrong.');
            return redirect('doctor-list');
        }
    }

    /**
     * Method to change Doctor status
     * @param Illuminate\Http\Request $request
     * @return Response array
     * 
     */
    public function changeStatus(Request $request)
    {
        try {
            $doctor = Doctors::find($request->doctor_id);
            if($doctor == null) { // If details not found then return
                return redirect('doctor-list')->with('error', 'Details not found');
            }
            $doctor->status = ($request->status == "active") ? 'Active' : 'Inactive';
            $doctor->save();
            return Response::json(array('status' => true, 'msg' => 'Status changed successfully.'));
        } catch(\Exception $e) {
            Log::error("Error in changeStatus on DoctorController ". $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }

    /**
     * Method to change Doctor Sponsored status
     * @param Illuminate\Http\Request $request
     * @return Response array
     * 
     */
    public function changeSponsoredStatus(Request $request)
    {
        try {
            $doctor = Doctors::find($request->doctor_id);
            if($doctor == null) { // If details not found then return
                return redirect('doctor-list')->with('error', 'Details not found');
            }
            $doctor->sponsored = $request->sponsored;
            $doctor->save();
            return Response::json(array('status' => true, 'msg' => 'Status changed successfully.'));
        } catch(\Exception $e) {
            Log::error("Error in changeSponsoredStatus on DoctorController ". $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }

    /**
     * Method to delete Doctor
     * @param int $doctor_id
     * @return redirect
     */
    public function delete(int $doctor_id = 0)
    {
        try {
            $doctor = Doctors::find($doctor_id);
            if($doctor == null) { // If details not found then return
                return redirect('doctor-list')->with('error', 'Details not found');
            }
            $user = $doctor->user;
            $user->delete();
            $doctor->delete();
            return redirect('doctor-list')->with('error', 'Record deleted successfully');
        } catch(\Exception $e) {
            Log::error("Error in delete on DoctorController ". $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }
}
