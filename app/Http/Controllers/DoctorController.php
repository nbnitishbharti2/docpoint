<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\DoctorRequest;
use App\Models\DoctorRegistration;
use App\Models\Doctor as Doctors;
use App\Models\AppointmentSlots;
use App\Models\Appointment;
use App\Helpers\CommanHelper;
use App\Models\DoctorHoliday;
use App\Models\Speciality;
use App\Models\Country;
use App\Models\Gender;
use App\Models\State;
use App\Models\City;
use App\Models\User;
use App\Models\Role;
use App\Models\Reason;
use App\Models\Review;
use App\Models\Affiliation;
use App\Models\PremiumCharge;
use App\Models\DefaultCharge;
use Response;
use Log;
use Auth;
use Illuminate\Support\Facades\DB;

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
            $data['active'] = 'doctors';
            return view('Doctor.index', $data);
        } catch (\Exception $e) {
            Log::error("Error in store on DoctorController " . $e->getMessage());
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
            $data['active'] = 'doctors';
            return view('Doctor.add', $data);
        } catch (\Exception $e) {
            Log::error("Error in store on DoctorController " . $e->getMessage());
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
                'country_id' => $input['country'],
                'state_id' => $input['state'],
                'city_id' => $input['city'],
                'gender_id' => $input['gender'],
                'address' => $input['address'],
                'zip' => $input['zip'],
                'password' => Hash::make('12345678'),
                'status' => ($request->has('status')) ? 'Active' : 'Inactive',
                'pic' => $input['pic'] ?? '',
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
                'pic' => $input['pic'] ?? '',
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
                'physical' => ($request->has('physical')) ? 'Yes' : 'No',
                'video' => ($request->has('video')) ? 'Yes' : 'No',
            );
            Doctors::create($doctorData);
            // Attach role to user
            $doctor_role = Role::where('name', 'Doctor')->first();
            if ($doctor_role != null) {
                CommanHelper::attachRole($user, $doctor_role);
            }

            if ($input['registered_id'] != '') {
                DoctorRegistration::where('id', $input['registered_id'])->update(['status' => 'Approved']);
            }
            return redirect('doctor-list')->with('message', 'Details added successfully');
        } catch (\Exception $e) {
            Log::error("Error in store on DoctorController " . $e->getMessage());
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
            $data['active'] = 'doctors';
            return view('Doctor.edit', $data);
        } catch (\Exception $e) {
            Log::error("Error in edit on DoctorController " . $e->getMessage());
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
            if ($doctor->pic != null && file_exists('storage/images/doctor/' . $doctor->pic)) {
                unlink(storage_path('app/public/images/doctor/' . $doctor->pic));
            }

            $userData = array(
                'name' => $input['name'],
                'email' => $input['email'],
                'mobile' => $input['mobile'],
                'pic' => $input['pic'] ?? '',
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
                'pic' => $input['pic'] ?? '',
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
                'physical' => ($request->has('physical')) ? 'Yes' : 'No',
                'video' => ($request->has('video')) ? 'Yes' : 'No',
            );

            Doctors::where('id', $id)->update($doctorData);
            if(CommanHelper::userRole() == "Admin") {
                return redirect('doctor-list')->with('message', 'Doctor details updated successfully');
            }
            return redirect('dashboard')->with('message', 'Profile updated successfully');
        } catch (\Exception $e) {
            Log::error("Error in update on DoctorController " . $e->getMessage());
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
            if ($data['doctor'] == null) {
                return redirect('doctor-list')->with('error', 'Details not found');
            }
            $data['active'] = 'doctors';
            return view('Doctor.profile', $data);
        } catch (\Exception $e) {
            Log::error("Error in myProfile on DoctorController " . $e->getMessage());
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
            if ($doctor == null) { // If details not found then return
                return redirect('doctor-list')->with('error', 'Details not found');
            }
            $doctor->status = ($request->status == "active") ? 'Active' : 'Inactive';
            $doctor->save();
            return Response::json(array('status' => true, 'msg' => 'Status changed successfully.'));
        } catch (\Exception $e) {
            Log::error("Error in changeStatus on DoctorController " . $e->getMessage());
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
            if ($doctor == null) { // If details not found then return
                return redirect('doctor-list')->with('error', 'Details not found');
            }
            $doctor->sponsored = $request->sponsored;
            $doctor->save();
            return Response::json(array('status' => true, 'msg' => 'Status changed successfully.'));
        } catch (\Exception $e) {
            Log::error("Error in changeSponsoredStatus on DoctorController " . $e->getMessage());
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
            if ($doctor == null) { // If details not found then return
                return redirect('doctor-list')->with('error', 'Details not found');
            }
            $user = $doctor->user;
            $user->delete();
            $doctor->delete();
            return redirect('doctor-list')->with('error', 'Record deleted successfully');
        } catch (\Exception $e) {
            Log::error("Error in delete on DoctorController " . $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }

    /**
     * Method to show Doctors list
     * @param Illuminate\Http\Request $request
     * @return redirect
     */
    public function list(Request $request)
    {
        // dd($request->all()); 
        $data['gender_list']=array();
        $data['speciality_list']=array();
        $data['sponsored_list']=array();
        $data['affiliation_list']=array();
        $resion=Reason::find($request->resion); 

        // selectRaw('CAST(
        //     6371 * ACOS(
        //         COS(RADIANS(28.6172811))  COS(RADIANS(doctors.latitude))  COS(
        //             RADIANS(doctors.longitude) - RADIANS(82.9739144)
        //         ) + SIN(RADIANS(28.6172811)) * SIN(RADIANS(doctors.latitude))
        //     ) AS DECIMAL(10, 2)
        // ) AS distance')->
         //select CAST(6371 * ACOS( COS(RADIANS(28.6172811))+COS(RADIANS(doctors.latitude)) - COS( RADIANS(doctors.longitude) - RADIANS(82.9739144) ) + SIN(RADIANS(28.6172811)) * SIN(RADIANS(doctors.latitude)) ) AS DECIMAL(10, 2)) AS distance from doctors

        
         $q= Doctors::whereHas('country', function ($query) use ($request) {
            $query->where('name', $request->search);
        })->orwhereHas('city', function ($query) use ($request) {
            $query->where('name', $request->search);
        })->orwhereHas('state', function ($query) use ($request) {
            $query->where('name', $request->search);
        })->withCount(['review as avg_rate' => function($query) {
            $query->select(DB::raw('avg((rate+wating_rate))'));
        }])->with(['doctorSpacilityMap.reason'])->orwhere('zip', $request->search)->orwhere('address', $request->search);
        if(!empty($request->gender)){
            $data['gender_list']=$request->gender;
            $q->whereIn('gender_id',$request->gender);
        }
        if(!empty($request->sponsored)){
            $data['sponsored_list']=$request->sponsored;
            $q->whereIn('sponsored',$request->sponsored);
        }
        if(!empty($request->speciality)){
            $specialitys=$request->speciality;
            $data['speciality_list']=$request->speciality; 
            if(!in_array($resion->speciality_id,$request->speciality)){
                array_push($specialitys,$resion->speciality_id); 
            }
            $q->whereHas('doctorSpacilityMap', function ($query) use ($specialitys) {
                $query->whereIn('speciality_id', $specialitys);
            });
        }else{
            $q->whereHas('doctorSpacilityMap', function ($query) use ($resion) {
                $query->where('speciality_id', $resion->speciality_id);
            });
        }
        if(!empty($request->affiliation)){ 
            $data['affiliation_list']=$request->affiliation; 
            
            $q->whereHas('doctorAffiliationMap', function ($query) use ($request) {
                $query->whereIn('affiliation_id', $request->affiliation);
            });
        }
        $q->selectRaw('CAST(6371 * ACOS( COS(RADIANS(28.6172811))+COS(RADIANS(doctors.latitude)) - COS( RADIANS(doctors.longitude) - RADIANS(82.9739144) ) + SIN(RADIANS(28.6172811)) * SIN(RADIANS(doctors.latitude)) ) AS DECIMAL(10, 2)
        ) AS distance');
        
        if($request->short==1){
            $data['doctors']=$q->orderBy('id','asc')->get();
        }else if($request->short==2){
            $data['doctors']=$q->orderBy('distance','desc')->get();
        }else if($request->short==3){
            $data['doctors']=$q->orderBy('avg_rate','desc')->get();
        }else{
            $data['doctors']=$q->orderBy('id','asc')->get();
        }
        //dd($data['doctors']);
        // $data['doctors']=$q->orderBy('id','asc')->get();
        // dd($data['doctors']);
        //  $data['doctors'] = Doctors::whereHasMorph(
        //     'doctors',
        //     [Country::class, State::class, City::class],
        //     function (Builder $query) {
        //         $query->where('name', 'noida');
        //     }
        // )->get();
        //  dd($data['doctors']);
        // $data['doctors'] = Doctors::get(); 
            // $gender=$data['doctors'] = Doctors::whereHas('country', function ($query) use ($request) {
            //     $query->where('name', $request->search);
            // })->orwhereHas('city', function ($query) use ($request) {
            //     $query->where('name', $request->search);
            // })->orwhereHas('state', function ($query) use ($request) {
            //     $query->where('name', $request->search);
            // })->with('gender')->orwhere('zip', $request->search)->orwhere('address', $request->search)->whereHas('doctorSpacilityMap', function ($query) use ($resion) {
            //     $query->where('speciality_id', $resion->speciality_id);
            // })->groupBy('gender_id')->count();
            // // $gender=Gender::whereHas('doctor', function ($query) use ($request) {
            //     $query->where('zip', $request->search)->orwhere('address', $request->search);
            // })->with('doctor')->groupBy('id')->count('genders.doctor');
          //  dd($gender);
        if(count($data['doctors'])==0) {
            $data['doctors'] = Doctors::whereHas('city', function ($query) use ($request) {
                $query->where('name', 'Delhi');
            })->where('speciality_id', $request->spacility)->orderBy('sponsored','asc')->get();
           
        } 
        foreach ($data['doctors'] as $value) {
            $data['appointments'][$value->id] =  AppointmentSlots::where('doctor_id', $value->id)->whereBetween('slot_date', [date('Y-m-d', strtotime($request->date . '-1 days')), date('Y-m-d', strtotime($request->date . '+3 days'))])->where('status', 'Available')->get()->toArray();
            $data['unique_sloat'][$value->id] =  AppointmentSlots::where('doctor_id', $value->id)->where('status', 'Available')->whereBetween('slot_date', [$request->date, date('Y-m-d', strtotime($request->date . '+3 days'))])->orderBy('slot_time')->get()->toArray();
        }


        // dd($request->date);
      //  $data['doctors'] = Doctors::get();
        $data['affiliation']=Affiliation::get();
        $data['gender']=Gender::get();
        $data['speciality']=Speciality::get();
        $data['search'] = $request->search ?? 'Delhi';
        $data['resion'] = $request->resion;
        $data['zip'] = $request->zip;
        $data['date'] = $request->date;
        $data['short']=(isset($request->short))?$request->short:1;
        $data['resion_list'] = Reason::orderBy('name','asc')->get();
        return view('frontend.doctors', $data);
    }

    /**
     * Method to show Doctor details
     * @param int $doctor_id
     * @return redirect
     */
    public function doctorDetails(int $doctor_id = 0, $sloat_id = '', $date = '')
    {
        try {
            $data['premium']=$this->checkPremiumAvalibility($sloat_id);
            $data['doctors'] = Doctors::find($doctor_id);
            $data['reason'] = Reason::get();
            $data['popular_reason'] = Appointment::groupBy('reason_id')->orderBy('id', 'desc')->take(5)->get();
            $data['date'] = ($date == '') ? date("Y-m-d") : date("Y-m-d", strtotime($date));
            $data['sloat_id'] = $sloat_id; 
            $data['sloat_details'] = AppointmentSlots::find($sloat_id);
            if(empty($data['sloat_details'])){
                $data['appointment_type']=''; 
            }else{
                $data['appointment_type']=$data['sloat_details']->appointment_type;
            } 
            $data['review_status'] = 'No';
            $data['waiting_total'] = Review::where(['doctor_id' => $doctor_id, 'status' => 'Approved'])->sum("wating_rate");
            $data['rate_total'] = Review::where(['doctor_id' => $doctor_id, 'status' => 'Approved'])->sum("rate");
            $data['doctor_reviews'] = Review::where(['doctor_id' => $doctor_id, 'status' => 'Approved'])->with('user')->orderBy('id', 'desc')->get();
            if ($data['doctors'] == null) { // If details not found then return
                return redirect('doctor-list')->with('error', 'Details not found');
            }
            if(Auth::User()) {
                $appointment = Appointment::where(['doctor_id' => $doctor_id, 'user_id' => Auth::user()->id])->count();
                $review = Review::where(['doctor_id' => $doctor_id, 'user_id' => Auth::user()->id])->count();
                if($appointment > 1 && $review == 0) {
                    $data['review_status'] = 'Yes';
                }
            }
            return view('frontend.doctor-details', $data);
        } catch (\Exception $e) {
            Log::error("Error in doctorDetails on DoctorController " . $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }

    public function holiday(int $doctor_id)
    {
        try {
            $data['holidays'] = DoctorHoliday::where('doctor_id', $doctor_id)->orderBy('date', 'desc')->get();
            $data['active'] = 'holiday';
            return view('holiday.index', $data);
        } catch (\Exception $e) {
            Log::error("Error in doctorDetails on DoctorController " . $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }

    public function getDoctorAppoinmentSlot(Request $request)
    {
        try {
            $date = date("Y-m-d", strtotime($request->date));
            $sloattype=$request->sloattype;
            if($sloattype==''){
                $unique_sloat = AppointmentSlots::where('doctor_id', $request->id)->where('appointment_type', 'Physical')->where('status', 'Available')->whereBetween('slot_date', [$date, date('Y-m-d', strtotime($date . '+3 days'))])->orderBy('slot_time')->groupBy('slot_time')->get();
				$slot_count = count($unique_sloat);
				if($slot_count>0){
					$sloattype='Physical';
				}else{
					$sloattype='Video';
				}
			}
            
            $unique_sloat = AppointmentSlots::where('doctor_id', $request->id)->where('appointment_type', $sloattype)->where('status', 'Available')->whereBetween('slot_date', [$date, date('Y-m-d', strtotime($date . '+3 days'))])->orderBy('slot_time')->groupBy('slot_time')->get();
            for ($i = 0; $i <= 3; $i++) {
                $ndate = date("Y-m-d", strtotime($date . ' +' . $i . ' day'));
                foreach ($unique_sloat as $key => $value) {
                    $checkSlot = AppointmentSlots::where('doctor_id', $request->id)->where('appointment_type', $sloattype)->where('slot_time', $value->slot_time)->where('slot_date', $ndate)->where('status', 'Available')->first();
                    if ($checkSlot == null) {
                        echo '<li><a href="javascript:void(0)" class="empty">--</a></li>';
                    } else {
                        if($request->page_type){
                            if($checkSlot->appointment_type == "Video") {
                                echo '<li><a href="'. route('doctor.details', [$checkSlot->doctor_id,$checkSlot->id,date("Ymd",strtotime($checkSlot->slot_date))]).'"><i class="icofont-video"></i> ' . date('h:i a', strtotime($checkSlot->slot_time)) . '</a></li>';
                            } else {
                                echo '<li><a href="'. route('doctor.details', [$checkSlot->doctor_id,$checkSlot->id,date("Ymd",strtotime($checkSlot->slot_date))]).'">' . date('h:i a', strtotime($checkSlot->slot_time)) . '</a></li>';
                            }
                        } else {
                            if($request->active==$checkSlot->id){
                                echo '<li class="active" id="li_'.$checkSlot->id.'"><a href="javascript:void(0)" onclick="setsloat2('.$checkSlot->id.')" ><i class="icofont-video"></i> '.date('h:i a', strtotime($checkSlot->slot_time)).'</a></li>';
                            }else{
                                echo '<li id="li_'.$checkSlot->id.'"><a href="javascript:void(0)" onclick="setsloat2('.$checkSlot->id.')" ><i class="icofont-video"></i> '.date('h:i a', strtotime($checkSlot->slot_time)).'</a></li>';
                            }
                            
                            
                        }
                          
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error("Error in getDoctorAppoinmentSlot on DoctorController " . $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }
     
    public function getDoctorAvaility(Request $request)
    {
        try{
            $doctorDetails=Doctors::find($request->id);
            $sponser='';
            if($doctorDetails->sponsored=='Yes'){
                $sponser='<i class="icofont-check"></i>';
            }
           // dd($doctorDetails);
            $image=($doctorDetails->pic && file_exists('public/storage/images/doctor/'.$doctorDetails->pic)) ? asset('public/storage/images/doctor/'.$doctorDetails->pic) : asset('public/storage/images/doctor/images.jpg');
            $data['date_append']='<div class="modal-body p-0">
            <div class="user-card col-dir">
              <div class="row  px-4 m-0 no-gutters fx-top w-100">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <div class="col-lg-2">
                  <img class="user-img small-img d-desktop-for-phone" src="'.$image.'" alt="doctor">
                </div>
                <div class="col-lg-10 pl-md-4">
                  <img class="user-img d-phone" src="'.$image.'" alt="doctor">
                  <h5>'.$doctorDetails->name. $sponser.'<span class="distance">1.51 Km</span></h5>
                  <h6>Dentist</h6>
                  
                  <div class="address">
                    <h5>'.$doctorDetails->address.'</h5> 
                  </div>
                  
                  <div class="rating">
                    <span>★ ★ ★ ★ ★</span>
                    <p class="total-rating">4</p>
                    <p class="rating-count">(969)</p>
                  </div>
                 
                </div>';
            if ($request->type == 1) {
                $date = date("Y-m-d", strtotime($request->availity_date . '+1 days'));
                $data['date']=date("Ymd",strtotime($date . '+14 days'));
            }else if ($request->type == 2) {
                $date = date("Y-m-d", strtotime($request->availity_date)); 
                $data['date']=date("Ymd",strtotime($date . '+14 days'));
            }else{ 
                $new_date = date("Ymd", strtotime($request->availity_date . '-14 days'));
                if($new_date>$request->min_date){
                    $date = date("Y-m-d", strtotime($new_date));
                    $data['date']=date("Ymd",strtotime($new_date . '-13 days')); 
                }else{
                    $date = date("Y-m-d", strtotime($request->min_date));
                    $data['date']=date("Ymd",strtotime($request->min_date));
                }
                
            }
            $data['date_append']=$data['date_append'].'<div class="col-lg-12"> 
            <div class="popup-date">
              <div class="one-line">
                <h2>'.date('M d',strtotime($date)).' - '.date('M d',strtotime($date. '+14 days')).'</h2> 
                <div class="slide-btns">
                  <button><i class="icofont-rounded-left" onclick="get_view_all_availability(3,'.$request->id.')"></i></button>
                  <button><i class="icofont-rounded-right" onclick="get_view_all_availability(1,'.$request->id.')"></i></button>
                </div> 
              </div>
              <p>Choose a time with Dr. '.$doctorDetails->name.' that works for you</p>
            </div> 
          </div></div><div class="row px-4 m-0 ">
          <div class="col-lg-12"> <div class="popup-dates">';
            // loop 
           
            $j=0;
            for($i=0; $i<=14; $i++){
                
                if($request->sloattype==''){
                    $checkSloat = AppointmentSlots::where('doctor_id', $request->id)->where('appointment_type', 'Physical')->where('slot_date', date('Y-m-d',strtotime($date. '+'.$i.' days')))->where('status', 'Available')->orderBy('slot_time','asc')->get();
                    if(count($checkSloat)>0){
                        $sloattype='Physical';
                    }else{
                        $checkSloat = AppointmentSlots::where('doctor_id', $request->id)->where('appointment_type', 'Video')->where('slot_date', date('Y-m-d',strtotime($date. '+'.$i.' days')))->where('status', 'Available')->orderBy('slot_time','asc')->get();
                        $sloattype='Video';
                    }
                   
                }else{ 
                    $sloattype=$request->sloattype;
                    $checkSloat = AppointmentSlots::where('doctor_id', $request->id)->where('appointment_type', $request->sloattype)->whereDate('slot_date', date('Y-m-d',strtotime($date. '+'.$i.' days')))->where('status', 'Available')->orderBy('slot_time','asc')->get();
                 } 
                if(count($checkSloat)>0){
                    $data['date_append']=$data['date_append'].'<div class="date-group">
                    <h6>'.date('D, M d',strtotime($date. '+'.$j.' days')).'</h6>
                    <ul class="time-btns" id="sloat-ul'.$j.'">';
                    $k=0;
                    foreach($checkSloat as $key => $value){
                        $k++;
                        if($k>10){
                            $data['date_append']=$data['date_append'].'<li style="width: 57px;"><a href="javascript:void(0)" onclick="availity_more_data('.$j.','.$request->id.','.date("Ymd",strtotime($value->slot_date)).', '."'".$sloattype."'".')">More</a></li>';
                            break;
                        }
                        if($sloattype=='Video'){
                            $data['date_append']=$data['date_append'].'<li><a href="'. route('doctor.details', [$value->doctor_id,$value->id,date("Ymd",strtotime($value->slot_date))]).'"><i class="icofont-video"></i>'.date('h:i a',strtotime(strtotime($value->slot_time))).'</a></li>';
                        }else{
                            $data['date_append']=$data['date_append'].'<li><a href="'. route('doctor.details', [$value->doctor_id,$value->id,date("Ymd",strtotime($value->slot_date))]).'">'.date('h:i a',strtotime(strtotime($value->slot_time))).'</a></li>';
                        } 
                    }
                    $data['date_append']=$data['date_append'].'</ul></div>'; 
                }else{
                    $data['date_append']=$data['date_append'].'<div class="date-group">
                  <h6>'.date('D, M d',strtotime($date. '+'.$j.' days')).'<span>No availability</span></h6>
                  </div>';
                }
                $j++;
            }
            
            $data['date_append']=$data['date_append'].'</div></div>
            <div class="col-lg-12">
              <button class="full-btn" onclick="get_view_all_availability(1,'.$request->id.')">'.date('M d',strtotime($date. '+15 days')).' - '.date('M d',strtotime($date. '+29 days')).'</button>
            </div>
            </div></div></div>';
           
            echo json_encode($data);
        } catch (\Exception $e) {
            Log::error("Error in getDoctorAvaility on DoctorController " . $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
        
    }

    public function getDoctorAvailityMore(Request $request)
    {
        try{
            $checkSloat = AppointmentSlots::where('doctor_id', $request->doctor_id)->where('appointment_type', $request->sloat_type)->where('slot_date', date('Y-m-d',strtotime($request->date)))->where('status', 'Available')->orderBy('slot_time','asc')->get();
            $data['date_append']='';
                foreach($checkSloat as $key => $value){ 
                    if($request->sloat_type=='Video'){
                        $data['date_append']=$data['date_append'].'<li><a href="'. route('doctor.details', [$value->doctor_id,$value->id,date("Ymd",strtotime($value->slot_date))]).'"><i class="icofont-video"></i>'.date('h:i a',strtotime(strtotime($value->slot_time))).'</a></li>';
                    }else{
                        $data['date_append']=$data['date_append'].'<li><a href="'. route('doctor.details', [$value->doctor_id,$value->id,date("Ymd",strtotime($value->slot_date))]).'">'.date('h:i a',strtotime(strtotime($value->slot_time))).'</a></li>';
                    } 
                } 
            echo json_encode($data);
        } catch (\Exception $e) {
            Log::error("Error in getDoctorAvailityMore on DoctorController " . $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }

    public function getDoctorAppoinmentSlotByDate(Request $request)
    {
        try {
           
            $width='62.25px';
            if($request->page_type){
                $width='92.2px';
            } 
            
            if ($request->type == 1) { 
               
                $data['date_list_start'] = date("Ymd", strtotime($request->date_list_start . '+4 days')); 
                $data['date_append'] ='<div class="owl-item" style="width: '.$width.'; margin-right: 10px;"><div class="date-item"><p>' . date("D", strtotime($request->date_list_start . '+4 days')) . '</p><h5>' . date("M d", strtotime($request->date_list_start . '+4 days')) . '</h5></div></div><div class="owl-item" style="width: '.$width.'; margin-right: 10px;"><div class="date-item"><p>' . date("D", strtotime($request->date_list_start . '+5 days')) . '</p><h5>' . date("M d", strtotime($request->date_list_start . '+5 days')) . '</h5></div></div><div class="owl-item" style="width: '.$width.'; margin-right: 10px;"><div class="date-item"><p>' . date("D", strtotime($request->date_list_start . '+6 days')) . '</p><h5>' . date("M d", strtotime($request->date_list_start . '+6 days')) . '</h5></div></div><div class="owl-item" style="width: '.$width.'; margin-right: 10px;"><div class="date-item"><p>' . date("D", strtotime($request->date_list_start . '+7 days')) . '</p><h5>' . date("M d", strtotime($request->date_list_start . '+7 days')) . '</h5></div></div>';
              //  $data['date_append'] = '<div class="owl-item" style="width: 92.2px; margin-right: 10px;"><div class="date-item"><p>' . date("D", strtotime($request->date_list_end . '+1 days')) . '</p><h5>' . date("M d", strtotime($request->date_list_end . '+1 days')) . '</h5></div></div>';
                   $date = date("Y-m-d", strtotime($request->date . '+4 days'));
            } else {
                if ($request->min_date < $request->date_list_start) {
                    $data['date_list_start'] = date("Ymd", strtotime($request->date_list_start . '-4 days'));
                    
                   // $data['date_append'] = '<div class="owl-item" style="width: 92.2px; margin-right: 10px;"><div class="date-item"><p>' . date("D", strtotime($request->date_list_start . '-1 days')) . '</p><h5>' . date("M d", strtotime($request->date_list_start . '-1 days')) . '</h5></div></div>';
                }else{
                    $data['date_list_start'] = date("Ymd");
                }
                $C_date=date("Ymd");
                if($request->date>$C_date){
                    $date = date("Y-m-d", strtotime($request->date . '-4 days'));
                    $data['date_append'] ='<div class="owl-item" style="width: '.$width.'; margin-right: 10px;"><div class="date-item"><p>' . date("D", strtotime($request->date_list_start . '-4 days')) . '</p><h5>' . date("M d", strtotime($request->date_list_start . '-4 days')) . '</h5></div></div><div class="owl-item" style="width: '.$width.'; margin-right: 10px;"><div class="date-item"><p>' . date("D", strtotime($request->date_list_start . '-3 days')) . '</p><h5>' . date("M d", strtotime($request->date_list_start . '-3 days')) . '</h5></div></div><div class="owl-item" style="width: '.$width.'; margin-right: 10px;"><div class="date-item"><p>' . date("D", strtotime($request->date_list_start . '-2 days')) . '</p><h5>' . date("M d", strtotime($request->date_list_start . '-2 days')) . '</h5></div></div><div class="owl-item" style="width: '.$width.'; margin-right: 10px;"><div class="date-item"><p>' . date("D", strtotime($request->date_list_start . '-1 days')) . '</p><h5>' . date("M d", strtotime($request->date_list_start . '-1 days')) . '</h5></div></div>';
                }else{
                    $date = date("Y-m-d", strtotime($C_date . '-4 days'));
                    $data['date_append'] ='<div class="owl-item" style="width: '.$width.'; margin-right: 10px;"><div class="date-item"><p>' . date("D", strtotime($date)) . '</p><h5>' . date("M d", strtotime($date)) . '</h5></div></div><div class="owl-item" style="width: '.$width.'; margin-right: 10px;"><div class="date-item"><p>' . date("D", strtotime($date . '+1 days')) . '</p><h5>' . date("M d", strtotime($date . '+1 days')) . '</h5></div></div><div class="owl-item" style="width: '.$width.'; margin-right: 10px;"><div class="date-item"><p>' . date("D", strtotime($date . '+2 days')) . '</p><h5>' . date("M d", strtotime($date . '+2 days')) . '</h5></div></div><div class="owl-item" style="width: '.$width.'; margin-right: 10px;"><div class="date-item"><p>' . date("D", strtotime($date . '+3 days')) . '</p><h5>' . date("M d", strtotime($date . '+3 days')) . '</h5></div></div>';
                }
                
            } 
            // $date=date("Y-m-d",strtotime($request->date));
            // $did=json_decode($request->ids);
            $sloat = array();
            foreach ($request->ids as $key => $val) {
                // echo $val;
                $sloat[$val] = '';
               
                $sloattype=$request->sloattype;
                if($sloattype==''){
                    $slot_count2 = AppointmentSlots::where('doctor_id', $val)->where('appointment_type', 'Physical')->where('status', 'Available')->whereBetween('slot_date', [$date, date('Y-m-d', strtotime($date . '+3 days'))])->orderBy('slot_time')->groupBy('slot_time')->get();
                    $slot_count = count($slot_count2);
                    if($slot_count>0){
                        $sloattype='Physical';
                    }else{
                        $sloattype='Video';
                    }
                }
               
                $video_class='icofont-video';
                $slot_count2 = AppointmentSlots::where('doctor_id', $val)->where('appointment_type', $sloattype)->where('status', 'Available')->whereBetween('slot_date', [$date, date('Y-m-d', strtotime($date . '+3 days'))])->orderBy('slot_time')->groupBy('slot_time')->get();
                
                if(count($slot_count2)>0){
                if(($slot_count2[0]->appointment_type=='Physical' && $slot_count2[0]->doctor->physical=="Yes") || ($slot_count2[0]->appointment_type=='Video' && $slot_count2[0]->doctor->video=="Yes")){
                        $slot_count = count($slot_count2);
                    }else{
                        $slot_count = 0;
                    }
                }else{
                    $slot_count = 0;
                }
                    
                $limit = ($slot_count > 4) ? 3 : 4;

                $unique_sloat = AppointmentSlots::where('doctor_id', $val)->where('appointment_type', $sloattype)->where('status', 'Available')->whereBetween('slot_date', [$date, date('Y-m-d', strtotime($date . '+3 days'))])->orderBy('slot_time')->groupBy('slot_time')->take($limit)->get();
                // echo count($unique_sloat);
                for ($i = 0; $i <= 3; $i++) {
                    $ndate = date("Y-m-d", strtotime($date . ' +' . $i . ' day'));
                    if($slot_count>0)
                    foreach ($unique_sloat as $key => $value) {

                        $checkSloat = AppointmentSlots::where('doctor_id', $val)->where('appointment_type', $sloattype)->where('slot_time', $value->slot_time)->where('slot_date', $ndate)->where('status', 'Available')->first();
                        if ($checkSloat == null) {
                            $sloat[$val] = $sloat[$val] . '<li><a href="javascript:void(0)" class="empty">--</a></li>';
                        } else {
                            if($request->page_type){
                                if($sloattype=='Video'){
                                    $sloat[$val] = $sloat[$val] .  '<li><a href="'. route('doctor.details', [$checkSloat->doctor_id,$checkSloat->id,date("Ymd",strtotime($checkSloat->slot_date))]).'"><i class="icofont-video"></i>' . date('h:i a', strtotime($checkSloat->slot_time)) . '</a></li>';
                                }else{
                                    $sloat[$val] = $sloat[$val] .  '<li><a href="'. route('doctor.details', [$checkSloat->doctor_id,$checkSloat->id,date("Ymd",strtotime($checkSloat->slot_date))]).'">' . date('h:i a', strtotime($checkSloat->slot_time)) . '</a></li>';
                                } 
                            }else{
                                if($request->active==$checkSloat->id){
                                    if($sloattype=='Video'){
                                        $sloat[$val] = $sloat[$val] .  '<li class="active" id="li_'.$checkSloat->id.'"><a href="javascript:void(0)" onclick="setsloat2('.$checkSloat->id.')" ><i class="icofont-video"></i>'.date('h:i a', strtotime($checkSloat->slot_time)).'</a></li>';
                                    }else{
                                        $sloat[$val] = $sloat[$val] .  '<li class="active" id="li_'.$checkSloat->id.'"><a href="javascript:void(0)" onclick="setsloat2('.$checkSloat->id.')" >'.date('h:i a', strtotime($checkSloat->slot_time)).'</a></li>';
                                    }
                                    
                                    }else{
                                        if($sloattype=='Video'){
                                            $sloat[$val] = $sloat[$val] .  '<li id="li_'.$checkSloat->id.'"><a href="javascript:void(0)" onclick="setsloat2('.$checkSloat->id.')" ><i class="icofont-video"></i>'.date('h:i a', strtotime($checkSloat->slot_time)).'</a></li>';
                                        }else{
                                            $sloat[$val] = $sloat[$val] .  '<li id="li_'.$checkSloat->id.'"><a href="javascript:void(0)" onclick="setsloat2('.$checkSloat->id.')" >'.date('h:i a', strtotime($checkSloat->slot_time)).'</a></li>';
                                        }
                                        
                                }
                                
                            } 
                        }
                    }
                    if ($slot_count < 4) {
                        for ($j = $slot_count; $j < 4; $j++) {
                            $sloat[$val] = $sloat[$val] . '<li><a href="javascript:void(0)" class="empty">--</a></li>';
                        }
                    }
                    if ($slot_count > 4) {
                        $check_more_sloat = AppointmentSlots::where('doctor_id', $val)->where('appointment_type', $sloattype)->where('slot_date', $ndate)->where('slot_time', '>', $value->slot_time)->where('status', 'Available')->count();
                        if ($check_more_sloat > 0) {
                            $sloat[$val] = $sloat[$val] . '<li><a href="javascript:void(0)" onclick="more_desktop(' . $val . ',' . date("Ymd", strtotime($date)) . ')">More</a></li>';
                        } else {
                            $sloat[$val] = $sloat[$val] . '<li><a href="javascript:void(0)" class="empty">--</a></li>';
                        }
                    }
                }
                if ($slot_count < 4) {
                    for ($i = 0; $i <= 3; $i++) {
                        for ($j = $slot_count; $j < 4; $j++) {
                            // $sloat[$val]= $sloat[$val].'<li><a href="#" class="empty">--</a></li>'; 
                        }
                    }
                }
            }
            $data['type'] = $request->type;
            $data['sloat'] = $sloat;
            $data['date'] = date("Ymd", strtotime($date));
            echo json_encode($data);
        } catch (\Exception $e) {
            Log::error("Error in getDoctorAppoinmentSlotByDate on DoctorController " . $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }
    

    public function getDoctorAppoinmentSlotChangeType(Request $request)
    {
        try {
            $width='62.25px';
            if($request->page_type){
                $width='92.2px';
            } 
           $date='';
            if ($request->type == 1) {
                $data['date_list_start'] = date("Ymd", strtotime($request->date_list_start));
                $data['date_append'] ='<div class="owl-item" style="width: '.$width.'; margin-right: 10px;"><div class="date-item"><p>' . date("D", strtotime($request->date_list_start . '+4 days')) . '</p><h5>' . date("M d", strtotime($request->date_list_start . '+4 days')) . '</h5></div></div><div class="owl-item" style="width: '.$width.'; margin-right: 10px;"><div class="date-item"><p>' . date("D", strtotime($request->date_list_start . '+5 days')) . '</p><h5>' . date("M d", strtotime($request->date_list_start . '+5 days')) . '</h5></div></div><div class="owl-item" style="width: '.$width.'; margin-right: 10px;"><div class="date-item"><p>' . date("D", strtotime($request->date_list_start . '+6 days')) . '</p><h5>' . date("M d", strtotime($request->date_list_start . '+6 days')) . '</h5></div></div><div class="owl-item" style="width: '.$width.'; margin-right: 10px;"><div class="date-item"><p>' . date("D", strtotime($request->date_list_start . '+7 days')) . '</p><h5>' . date("M d", strtotime($request->date_list_start . '+7 days')) . '</h5></div></div>';
              
                $date = date("Y-m-d", strtotime($request->date));
            } else {
                    if ($request->min_date < $request->date_list_start) {
                        $data['date_list_start'] = date("Ymd", strtotime($request->date_list_start));
                    }else{
                            $data['date_list_start'] = date("Ymd");
                    }
                    $C_date=date("Ymd");
                    if($request->date>$C_date){
                         $date = date("Y-m-d", strtotime($request->date));
                         $data['date_append'] ='<div class="owl-item" style="width: '.$width.'; margin-right: 10px;"><div class="date-item"><p>' . date("D", strtotime($request->date_list_start . '-4 days')) . '</p><h5>' . date("M d", strtotime($request->date_list_start . '-4 days')) . '</h5></div></div><div class="owl-item" style="width: '.$width.'; margin-right: 10px;"><div class="date-item"><p>' . date("D", strtotime($request->date_list_start . '-3 days')) . '</p><h5>' . date("M d", strtotime($request->date_list_start . '-3 days')) . '</h5></div></div><div class="owl-item" style="width: '.$width.'; margin-right: 10px;"><div class="date-item"><p>' . date("D", strtotime($request->date_list_start . '-2 days')) . '</p><h5>' . date("M d", strtotime($request->date_list_start . '-2 days')) . '</h5></div></div><div class="owl-item" style="width: '.$width.'; margin-right: 10px;"><div class="date-item"><p>' . date("D", strtotime($request->date_list_start . '-1 days')) . '</p><h5>' . date("M d", strtotime($request->date_list_start . '-1 days')) . '</h5></div></div>';
                    }else{
                         $date = date("Y-m-d", strtotime($C_date));
                         $data['date_append'] ='<div class="owl-item" style="width: '.$width.'; margin-right: 10px;"><div class="date-item"><p>' . date("D", strtotime($date)) . '</p><h5>' . date("M d", strtotime($date)) . '</h5></div></div><div class="owl-item" style="width: '.$width.'; margin-right: 10px;"><div class="date-item"><p>' . date("D", strtotime($date . '+1 days')) . '</p><h5>' . date("M d", strtotime($date . '+1 days')) . '</h5></div></div><div class="owl-item" style="width: '.$width.'; margin-right: 10px;"><div class="date-item"><p>' . date("D", strtotime($date . '+2 days')) . '</p><h5>' . date("M d", strtotime($date . '+2 days')) . '</h5></div></div><div class="owl-item" style="width: '.$width.'; margin-right: 10px;"><div class="date-item"><p>' . date("D", strtotime($date . '+3 days')) . '</p><h5>' . date("M d", strtotime($date . '+3 days')) . '</h5></div></div>';
                    }
                
            } 
            $sloat = array();
            foreach ($request->ids as $val) {
                
                $sloat[$val] = '';

                $sloattype=$request->sloattype;
                
                if($sloattype==''){
                    $slot_count2 = AppointmentSlots::where('doctor_id', $val)->where('appointment_type', 'Physical')->where('status', 'Available')->whereBetween('slot_date', [$date, date('Y-m-d', strtotime($date . '+3 days'))])->orderBy('slot_time')->groupBy('slot_time')->get();
                    $slot_count = count($slot_count2);
                    if($slot_count>0){
                        $sloattype='Physical';
                    }else{
                        $sloattype='Video';
                    }
                }

                $slot_count2 = AppointmentSlots::where('doctor_id', $val)->where('appointment_type', $sloattype)->where('status', 'Available')->whereBetween('slot_date', [$date, date('Y-m-d', strtotime($date . '+3 days'))])->orderBy('slot_time')->groupBy('slot_time')->get();
                if(count($slot_count2)>0){
                    if(($slot_count2[0]->appointment_type=='Physical' && $slot_count2[0]->doctor->physical=="Yes") || ($slot_count2[0]->appointment_type=='Video' && $slot_count2[0]->doctor->video=="Yes")){
                            $slot_count = count($slot_count2);
                        }else{
                            $slot_count = 0;
                        }
                    }else{
                        $slot_count = 0;
                    }
                    $data['slot_count'] = $slot_count;
                $limit = ($slot_count > 4) ? 3 : 4;

                $unique_sloat = AppointmentSlots::where('doctor_id', $val)->where('appointment_type', $sloattype)->where('status', 'Available')->whereBetween('slot_date', [$date, date('Y-m-d', strtotime($date . '+3 days'))])->orderBy('slot_time')->groupBy('slot_time')->take($limit)->get();
                
                for ($i = 0; $i <= 3; $i++) {
                    $ndate = date("Y-m-d", strtotime($date . ' +' . $i . ' day'));
                    if($slot_count>0)
                    foreach ($unique_sloat as $key => $value) {

                        $checkSloat = AppointmentSlots::where('doctor_id', $val)->where('appointment_type', $sloattype)->where('slot_time', $value->slot_time)->where('slot_date', $ndate)->where('status', 'Available')->first();
                        if ($checkSloat == null) {
                            $sloat[$val] = $sloat[$val] . '<li><a href="javascript:void(0)" class="empty">--</a></li>';
                        } else {
                            if($request->page_type){
                                if($checkSloat->appointment_type == "Video") {
                                    $sloat[$val] = $sloat[$val] .  '<li><a href="'. route('doctor.details', [$checkSloat->doctor_id,$checkSloat->id,date("Ymd",strtotime($checkSloat->slot_date))]).'"><i class="icofont-video"></i> ' . date('h:i A', strtotime($checkSloat->slot_time)) . '</a></li>';
                                } else {
                                    $sloat[$val] = $sloat[$val] .  '<li><a href="'. route('doctor.details', [$checkSloat->doctor_id,$checkSloat->id,date("Ymd",strtotime($checkSloat->slot_date))]).'">' . date('h:i A', strtotime($checkSloat->slot_time)) . '</a></li>';
                                }
                            }else{
                                if($request->active==$checkSloat->id){
                                    if($checkSloat->appointment_type == "Video") {
                                        $sloat[$val] = $sloat[$val] .  '<li class="active" id="li_'.$checkSloat->id.'"><a href="javascript:void(0)" onclick="setsloat2('.$checkSloat->id.')" ><i class="icofont-video"></i> '.date('h:i A', strtotime($checkSloat->slot_time)).'</a></li>';
                                    } else {
                                        $sloat[$val] = $sloat[$val] .  '<li class="active" id="li_'.$checkSloat->id.'"><a href="javascript:void(0)" onclick="setsloat2('.$checkSloat->id.')" >'.date('h:i A', strtotime($checkSloat->slot_time)).'</a></li>';
                                    }
                                } else {
                                    if($checkSloat->appointment_type == "Video") {
                                        $sloat[$val] = $sloat[$val] .  '<li id="li_'.$checkSloat->id.'"><a href="javascript:void(0)" onclick="setsloat2('.$checkSloat->id.')" ><i class="icofont-video"></i> '.date('h:i A', strtotime($checkSloat->slot_time)).'</a></li>';
                                    } else {
                                        $sloat[$val] = $sloat[$val] .  '<li id="li_'.$checkSloat->id.'"><a href="javascript:void(0)" onclick="setsloat2('.$checkSloat->id.')" >'.date('h:i A', strtotime($checkSloat->slot_time)).'</a></li>';
                                    }
                                }
                                
                            } 
                        }
                    }
                    if ($slot_count < 4) {
                        for ($j = $slot_count; $j < 4; $j++) {
                            $sloat[$val] = $sloat[$val] . '<li><a href="javascript:void(0)" class="empty">--</a></li>';
                        }
                    }
                    if ($slot_count > 4) {
                        $check_more_sloat = AppointmentSlots::where('doctor_id', $val)->where('appointment_type', $sloattype)->where('slot_date', $ndate)->where('slot_time', '>', $value->slot_time)->where('status', 'Available')->count();
                        if ($check_more_sloat > 0) {
                            $sloat[$val] = $sloat[$val] . '<li><a href="javascript:void(0)" onclick="more_desktop(' . $val . ',' . date("Ymd", strtotime($date)) . ')">More</a></li>';
                        } else {
                            $sloat[$val] = $sloat[$val] . '<li><a href="javascript:void(0)" class="empty">--</a></li>';
                        }
                    }
                }
                if ($slot_count < 4) {
                    for ($i = 0; $i <= 3; $i++) {
                        for ($j = $slot_count; $j < 4; $j++) {
                            
                        }
                    }
                }
            }
            $data['type'] = $request->type;
            $data['sloat'] = $sloat;
            $data['date'] = date("Ymd", strtotime($date));
            return json_encode($data);
        } catch (\Exception $e) {
            Log::error("Error in getDoctorAppoinmentSlotChangeType on DoctorController " . $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }
    /**
     * Method to show form for add Holiday
     */
    public function addHoliday()
    {
        try {
            $data['active'] = 'holiday';
            return view('holiday.add', $data);
        } catch (\Exception $e) {
            Log::error("Error in addHoliday on DoctorController " . $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Method to store Holiday
     * @param Request $request
     * @return redirect
     */
    public function storeHoliday(Request $request)
    {
        try {
            $data = [
                'doctor_id' => Auth::user()->doctors->id,
                'date' => date("Y-m-d", strtotime($request->date)),
                'leave_day' => date('l', strtotime(date("Y-m-d", strtotime($request->date))))
            ];
            DoctorHoliday::create($data);
            return redirect('add-holiday')->with('message', 'Holiday added successfully');
        } catch (\Exception $e) {
            Log::error("Error in storeHoliday on DoctorController " . $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Method to delete Holiday
     * @param int $holiday_id
     * @return redirect
     */
    public function deleteHoliday($holiday_id = 0)
    {
        try {
            $holiday = DoctorHoliday::find($holiday_id);
            if($holiday) {
                $holiday->delete();
                return back()->with('message', 'Holiday deleted successfully');
            }
            return back()->with('error', 'Details not found.');
        } catch (\Exception $e) {
            Log::error("Error in deleteHoliday on DoctorController " . $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }


    public function booking($sloat_id = '')
    {

        try {
            $data['sloat'] = AppointmentSlots::find($sloat_id); 
            if ($data['sloat'] == null) { // If details not found then return
                return redirect()->back()->with('error', 'Details not found');
            } 
            return view('frontend.booking', $data);
        } catch (\Exception $e) {
            Log::error("Error in doctorDetails on DoctorController " . $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }
    public function paymentOption($id)
    {
        try {
            $data['booking'] = Appointment::find($id);
             $data['id'] = $id;
            $data['charge'] = $this->CalculateCharge($data['booking']); 
            if ($data['booking'] == null) { // If details not found then return 
                return redirect('/')->with('error', 'Details not found'); 
            } 
            return view('frontend.payment-option', $data);
        } catch (\Exception $e) {
            Log::error("Error in paymentOption on DoctorController " . $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }
    public function paymentOptionsave(Request $request, $id)
    {
         try {
           
            $data['booking'] = Appointment::find($id); 
            $data['charge'] = $this->CalculateCharge($data['booking'],$request->payment_type); 
            if ($data['booking'] == null) { // If details not found then return 
                return redirect('/')->with('error', 'Details not found'); 
            } 
            $data['booking']->total=$data['charge']['charge'];
            $data['booking']->admin_com=number_format((float)(($data['charge']['charge']*$data['charge']['comm'])/100), 2, '.', '');
            $data['booking']->doctor_com=$data['booking']->total-$data['booking']->admin_com;
            if($request->payment_type=='cash'){
                if($data['booking']->doctors->gender_id==1){
                    $data['booking']->status='Approved';
                }
                $data['booking']->payment_mode='Cash';
                $data['booking']->payment_status='Done';
                $data['booking']->admin_due=$data['booking']->admin_com;
            }
            $data['booking']->save();
            if($request->payment_type=='cash'){
                return redirect('/')->with('message', 'Appontment boocked successfully');
            }else{
                $this->paymentOptionOnline($id);
               return redirect('/')->with('message', 'Appontment boocked successfully'); 
            }
           // return view('frontend.payment-option', $data);
        } catch (\Exception $e) {
            Log::error("Error in paymentOptionsave on DoctorController " . $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }
    public function paymentOptionOnline($id)
    {
        try { 
            $data['booking'] = Appointment::find($id);
            $data['charge'] = $this->CalculateCharge($data['booking'],'online');
            if ($data['booking'] == null) { // If details not found then return 
                return redirect('/')->with('error', 'Details not found'); 
            }   
            if($data['booking']->doctors->gender_id==1){
                    $data['booking']->status='Approved';
            }
            $data['booking']->payment_mode='Online';
            $data['booking']->payment_status='Done';
            $data['booking']->doctor_due=$data['booking']->doctor_com; 
            $data['booking']->save(); 
            return redirect('/')->with('message', 'Appontment boocked successfully'); 
        } catch (\Exception $e) {
            Log::error("Error in paymentOptionOnline on DoctorController " . $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }
    public function savebooking(Request $request)
    {
        try {
            $data['sloat'] = $appontment_sloat = AppointmentSlots::find($request->sloat);
            if ($data['sloat'] == null) { // If details not found then return
                return redirect()->back()->with('error', 'Details not found');
            } else {
                $apponment = array(
                    'user_id' => Auth::user()->id,
                    'doctor_id' => $appontment_sloat->doctor_id,
                    'appointment_slot_id' => $appontment_sloat->id,
                    'reason_id' => $request->resion,
                    'patient_type' => $request->patient_type,
                    'appointment_type' => $request->appointment_type,
                    'appointment_date' => $appontment_sloat->slot_date,
                );
                $apponment= new Appointment();
                $apponment->user_id= Auth::user()->id;
                $apponment->doctor_id= $appontment_sloat->doctor_id;
                $apponment->appointment_slot_id= $appontment_sloat->id;
                $apponment->reason_id= $request->resion;
                $apponment->patient_type= $request->patient_type;
                $apponment->appointment_type= $request->appointment_type;
                $apponment->appointment_date= $appontment_sloat->slot_date;
                if ($apponment->save()) {
                    $appontment_sloat->status = 'Booked';
                    $appontment_sloat->save();
                }
            }
            return redirect()->route('doctor.payment.option', [$apponment->id]); 
        } catch (\Exception $e) {
            Log::error("Error in savebooking on DoctorController " . $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }

    /**
     * Method to show listings of registered doctor
     * 
     * @return array $data
     */
    public function registeredDoctor()
    {
        try {
            $data['doctors'] = DoctorRegistration::orderBy('id', 'desc')->get();
            $data['active'] = 'doctors';
            return view('Doctor.registered', $data);
        } catch (\Exception $e) {
            Log::error("Error in registeredDoctor on DoctorController " . $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Method to show registered doctor details to approve
     * @param int $reg_doctor_id
     * 
     * @return view
     */
    public function changeRegisteredDoctorStatus($reg_doctor_id = 0)
    {
        try {
            $data['doctor'] = DoctorRegistration::find($reg_doctor_id);
            $data['specialities'] = Speciality::get();
            $data['countries'] = Country::get();
            $data['genders'] = Gender::get();
            $data['active'] = 'doctors';
            return view('Doctor.add', $data);
        } catch (\Exception $e) {
            Log::error("Error in changeRegisteredDoctorStatus on DoctorController " . $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Method to reject registered doctor
     * @param int $reg_doctor_id
     * 
     * @return redirect
     */
    public function rejectRegisteredDoctor($reg_doctor_id = 0)
    {
        try {
            $data['doctor'] = DoctorRegistration::find($reg_doctor_id)->update(['status' => 'Rejected']);
            $data['active'] = 'doctors';
            return redirect()->back()->with('message', 'Status updated successfully');
        } catch (\Exception $e) {
            Log::error("Error in changeRegisteredDoctorStatus on DoctorController " . $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function CalculateCharge($booking, $type='')
    {
        $data=PremiumCharge::where('doctor_id',$booking->doctor_id)->first();
        $amt_name='';
        $amt=array();
        if($booking->appointment_type=='In-Person'){
             $amt_name='physical_';
        }else{
            $amt_name='video_';
        }
        if($booking->booking_type=='Normal'){
             $amt_name .='normal_';
        }else{
            $amt_name .='premium_';
        }
        $comm='';
        if($type!=''){
            $comm=$amt_name.'commission_';
            if($type=='online'){
                $comm .='online';
            }else{
                $comm .='cash';
            }
        }
        $status_online=$amt_name.'commission_online_status';
        $status_cash=$amt_name.'commission_cash_status';
         $amt_name .='charge';
        if($data==null){
            $data=DefaultCharge::find(1);
             if($comm!=''){
                $amt['comm']=$data->$comm;
            }
            $amt['charge']=$data->$amt_name;
            $amt['status_cash']=$data->$status_cash;
            $amt['status_online']=$data->$status_online;
        }else{
            if($comm!=''){
                $amt['comm']=$data->$comm;
            }
            $amt['charge']=$data->$amt_name;
            $amt['status_cash']=$data->$status_cash;
            $amt['status_online']=$data->$status_online;
        }
       return $amt; 
    }
    public function checkPremiumAvalibility($sloat_id='')
    {
       try {
            if($sloat_id==''){
                return 0;
            }else{
                $sloat_data=AppointmentSlots::find($sloat_id);
                if($sloat_data==null){
                   return 0; 
                }else{
                    $premum_data=PremiumCharge::where('doctor_id',$sloat_data->doctor_id)->first();
                    if($premum_data==null){
                       return 0; 
                    }else{
                        $no_of_patient=$premum_data->no_of_patient;
                        $premium_patient=$premum_data->premium_patient;
                        $normal_total=Appointment::where('doctor_id',$sloat_data->doctor_id)->where('payment_status','Done')->where('booking_type','Normal')->where('payment_status','Done')->where('appointment_date',$sloat_data->slot_date)->count();
                        $premium_total=Appointment::where('doctor_id',$sloat_data->doctor_id)->where('payment_status','Done')->where('booking_type','Premium')->where('payment_status','Done')->where('appointment_date',$sloat_data->slot_date)->count(); 

                       $premium_allowed= (((int) ($normal_total/$no_of_patient))+1)* $premium_patient;
                        if($premium_allowed>$premium_total){
                            return 1;
                        }else{
                            return 0;
                        } 
                    }
                }  
            }
            
        } catch (\Exception $e) {
            Log::error("Error in checkPremiumAvalibility on DoctorController " . $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }
}
