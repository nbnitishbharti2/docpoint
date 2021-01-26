<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AppointmentSlots extends Model
{
	use SoftDeletes;

	protected $fillable = ["doctor_id", "slot_date", "slot_date_time", "slot_time", "slot_end_time", "status", "appointment_type"];

	public function appointments()
    {
        return $this->hasMany('App\Models\Appointment');
    }
    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    } 
	public static function getSloat($id='', $date, $type=1, $active='',$sloattype='')
	{ 
		try {
			 
			if($sloattype==''){
				$slot_count2=AppointmentSlots::where('doctor_id', $id)->where('appointment_type', 'Physical')->where('status', 'Available')->whereBetween('slot_date', [$date, date('Y-m-d',strtotime($date.'+3 days'))])->orderBy('slot_time')->groupBy('slot_time')->get();
				$slot_count = count($slot_count2);
				if($slot_count>0){
					$sloattype='Physical';
				}else{
					$sloattype='Video';
				}
			}
			$slot_count2=AppointmentSlots::where('doctor_id', $id)->where('appointment_type', $sloattype)->where('status', 'Available')->whereBetween('slot_date', [$date, date('Y-m-d',strtotime($date.'+3 days'))])->orderBy('slot_time')->groupBy('slot_time')->get();
			//dd($slot_count2[0]->doctor);
			//dd($slot_count2[0]->appointment_type);
			if(($slot_count2[0]->appointment_type=='Physical' && $slot_count2[0]->doctor->physical=="Yes") || ($slot_count2[0]->appointment_type=='Video' && $slot_count2[0]->doctor->video=="Yes")){
				$slot_count = count($slot_count2);
			}else{
				$slot_count = 0;
			}
			
			$limit=($slot_count>4)?3:4; 
			$unique_sloat=AppointmentSlots::where('doctor_id', $id)->where('appointment_type', $sloattype)->where('status', 'Available')->whereBetween('slot_date', [$date, date('Y-m-d',strtotime($date.'+3 days'))])->orderBy('slot_time')->groupBy('slot_time')->take($limit)->get(); 
			for($i=0; $i<=3; $i++){
				$ndate=date("Y-m-d",strtotime($date. ' +'.$i.' day'));
				if($slot_count>0)
				foreach ($unique_sloat as $key => $value) {  
					$checkSloat=AppointmentSlots::where('doctor_id', $id)->where('appointment_type', $sloattype)->where('slot_time',$value->slot_time)->where('slot_date',$ndate)->where('status', 'Available')->first();
					if($checkSloat==null){ 
						echo '<li><a href="#" class="empty">--</a></li>';
					}else{ 
						if($type==1) {
							if($checkSloat->appointment_type == "Video") {
								echo '<li><a href="'. route('doctor.details', [$checkSloat->doctor_id,$checkSloat->id,date("Ymd",strtotime($checkSloat->slot_date))]).'"><i class="icofont-video"></i> '.date('h:i A', strtotime($checkSloat->slot_time)).'</a></li>';
							} else {
								echo '<li><a href="'. route('doctor.details', [$checkSloat->doctor_id,$checkSloat->id,date("Ymd",strtotime($checkSloat->slot_date))]).'">'.date('h:i A', strtotime($checkSloat->slot_time)).'</a></li>';
							}
							
						} else {
							if($active==$checkSloat->id){
								if($checkSloat->appointment_type == "Video") {
									echo '<li class="active" id="li_'.$checkSloat->id.'"><a href="javascript:void(0)" onclick="setsloat2('.$checkSloat->id.')" ><i class="icofont-video"></i> '.date('h:i A', strtotime($checkSloat->slot_time)).'</a></li>';
								} else {
									echo '<li class="active" id="li_'.$checkSloat->id.'"><a href="javascript:void(0)" onclick="setsloat2('.$checkSloat->id.')" >'.date('h:i A', strtotime($checkSloat->slot_time)).'</a></li>';
								}
							} else {
								if($checkSloat->appointment_type == "Video") {
									echo '<li id="li_'.$checkSloat->id.'"><a href="javascript:void(0)" onclick="setsloat2('.$checkSloat->id.')" ><i class="icofont-video"></i> '.date('h:i A', strtotime($checkSloat->slot_time)).'</a></li>';
								} else {
									echo '<li id="li_'.$checkSloat->id.'"><a href="javascript:void(0)" onclick="setsloat2('.$checkSloat->id.')" >'.date('h:i A', strtotime($checkSloat->slot_time)).'</a></li>';
								}
								
							}
						}
						//echo '<li><a href="#">'.date('h:i a', strtotime($checkSloat->slot_time)).'</a></li>';
					} 
				} 
				if($slot_count<4){
					for ($j=$slot_count; $j<4; $j++) { 
						echo '<li><a href="javascript:void(0)" class="empty">--</a></li>'; 
					}
				}
				if($slot_count>4){
					$check_more_sloat=AppointmentSlots::where('doctor_id', $id)->where('appointment_type', $sloattype)->where('slot_date',$ndate)->where('slot_time', '>',$value->slot_time)->where('status', 'Available')->count(); 
					if($check_more_sloat>0){
						echo '<li><a href="javascript:void(0)" onclick="more_desktop('.$id.','.date("Ymd",strtotime($date)).', '."'".$sloattype."'".')">More</a></li>';
					}else{
						echo '<li><a href="javascript:void(0)" class="empty">--</a></li>';
					} 
				}
			} 
			if($slot_count<4){
				for($i=0; $i<=3; $i++){
					for ($j=$slot_count; $j<4; $j++) { 
					//	echo '<li><a href="#" class="empty">--</a></li>'; 
					} 
				}
			}
		} catch(\Exception $e) {
			\Log::error("Error in getSloat on AppointmentSlots " . $e->getMessage() . ' On line no ' .$e->getLine());
		}
	}
	public static function getSloatTab($id='', $date)
	{
		$slot_count2=AppointmentSlots::where('doctor_id', $id)->where('status', 'Available')->whereBetween('slot_date', [$date, date('Y-m-d',strtotime($date.'+3 days'))])->orderBy('slot_time')->groupBy('slot_time')->get();
		$slot_count = count($slot_count2);
		$limit=($slot_count>4)?3:4;
		$slot_count=AppointmentSlots::where('doctor_id', $id)->where('status', 'Available')->where('slot_date', $date)->orderBy('slot_time')->groupBy('slot_time')->count();
		$limit=($slot_count>4)?3:4;
		$unique_sloat=AppointmentSlots::where('doctor_id', $id)->where('status', 'Available')->where('slot_date',$date)->orderBy('slot_time')->groupBy('slot_time')->take($limit)->get(); 
		foreach ($unique_sloat as $key => $value) {  
			$checkSloat=AppointmentSlots::where('doctor_id', $id)->where('slot_time',$value->slot_time)->where('slot_date',$date)->where('status', 'Available')->first();
			if($checkSloat==null){ 
				echo '<li><a href="javascript:void(0)" class="empty">--</a></li>';
			}else{ 
				if($type==1){
						echo '<li><a href="'. route('doctor.details', [$checkSloat->doctor_id,$checkSloat->id,date("Ymd",strtotime($checkSloat->slot_date))]).'">'.date('h:i A', strtotime($checkSloat->slot_time)).'</a></li>';
					}else{
						echo '<li><a href="javascript:void(0)" onclick="setsloat2('.$checkSloat->id.')" ></i>'.date('h:i A', strtotime($checkSloat->slot_time)).'</a></li>';
					}
				//echo '<li><a href="'. route('doctor.booking', [$checkSloat->id]).'">'.date('h:i a', strtotime($checkSloat->slot_time)).'</a></li>';
			} 
		} 
		if($slot_count>4){
			$check_more_sloat=AppointmentSlots::where('doctor_id', $id)->where('slot_date',$ndate)->where('slot_time', '>',$value->slot_time)->where('status', 'Available')->count(); 
			if($check_more_sloat>0){
				echo '<li><a href="javascript:void(0)">More</a></li>';
			}else{
				echo '<li><a href="javascript:void(0)" class="empty">--</a></li>';
			} 
		} 
		if($slot_count<4){
			for($i=0; $i<=3; $i++){
				for ($j=$slot_count; $j<4; $j++) { 
					echo '<li><a href="javascript:void(0)" class="empty">--</a></li>';  
				} 
			}
		} 
	}
}
