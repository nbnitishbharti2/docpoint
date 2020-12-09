<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AppointmentSlots extends Model
{
	use SoftDeletes;

	protected $fillable = ["doctor_id", "slot_date", "slot_date_time", "slot_time", "status"];

	public static function getSloat($id='', $date)
	{ 
		$slot_count=AppointmentSlots::where('doctor_id', $id)->where('status', 'Available')->whereBetween('slot_date', [$date, date('Y-m-d',strtotime($date.'+3 days'))])->orderBy('slot_time')->count();
		$limit=($slot_count>4)?3:4;
		$unique_sloat=AppointmentSlots::where('doctor_id', $id)->where('status', 'Available')->whereBetween('slot_date', [$date, date('Y-m-d',strtotime($date.'+3 days'))])->orderBy('slot_time')->take($limit)->get(); 
		for($i=0; $i<=3; $i++) {
			$ndate=date("Y-m-d",strtotime($date. ' +'.$i.' day'));
			foreach ($unique_sloat as $key => $value) {  
				$checkSloat=AppointmentSlots::where('doctor_id', $id)->where('slot_time',$value->slot_time)->where('slot_date',$date)->where('status', 'Available')->first();
				if($checkSloat==null){ 
					echo '<li><a href="#" class="empty">--</a></li>';
				}else{ 
					echo '<li><a href="#">'.date('h:i a', strtotime($checkSloat->slot_time)).'</a></li>';
				} 
			} 
			if($slot_count>4){
				$check_more_sloat=AppointmentSlots::where('doctor_id', $id)->where('slot_date',$date)->where('slot_time', '>',$value->slot_time)->where('status', 'Available')->count(); 
				if($check_more_sloat>0){
					echo '<li><a href="javascript:void(0)" onclick="more_desktop('.$id.','.$date.')">More</a></li>';
				}else{
					echo '<li><a href="#" class="empty">--</a></li>';
				} 
			}
		} 
		if($slot_count<4){
			for($i=0; $i<=3; $i++){
				for ($j=$slot_count; $j<4; $j++) { 
					echo '<li><a href="#" class="empty">--</a></li>'; 
				} 
			}
		} 
	}
	public static function getSloatTab($id='', $date)
	{
		$slot_count=AppointmentSlots::where('doctor_id', $id)->where('status', 'Available')->where('slot_date', $date)->orderBy('slot_time')->count();
		$limit=($slot_count>4)?3:4;
		$unique_sloat=AppointmentSlots::where('doctor_id', $id)->where('status', 'Available')->where('slot_date',$date)->orderBy('slot_time')->take($limit)->get(); 
		foreach ($unique_sloat as $key => $value) {  
			$checkSloat=AppointmentSlots::where('doctor_id', $id)->where('slot_time',$value->slot_time)->where('slot_date',$date)->where('status', 'Available')->first();
			if($checkSloat==null){ 
				echo '<li><a href="#" class="empty">--</a></li>';
			}else{ 
				echo '<li><a href="#">'.date('h:i a', strtotime($checkSloat->slot_time)).'</a></li>';
			} 
		} 
		if($slot_count>4){
			$check_more_sloat=AppointmentSlots::where('doctor_id', $id)->where('slot_date',$date)->where('slot_time', '>',$value->slot_time)->where('status', 'Available')->count(); 
			if($check_more_sloat>0){
				echo '<li><a href="#">More</a></li>';
			}else{
				echo '<li><a href="#" class="empty">--</a></li>';
			} 
		} 
		if($slot_count<4){
			for($i=0; $i<=3; $i++){
				for ($j=$slot_count; $j<4; $j++) { 
					echo '<li><a href="#" class="empty">--</a></li>';  
				} 
			}
		} 
	}
}
