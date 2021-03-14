<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use App\Models\RolePermission;
use App\Models\Permission;
use App\Models\UserRole;
use App\Models\User;
use Log;

class CommanHelper
{
	const No      = 'No';
	const Yes     = 'Yes';
	

	/**
	* Method to check user permission
	* @param string $permission
	* @return boolean 
	*/
	public static function checkPermission($permission)
	{
		try {
			$permission_id 		= Permission::where('name', $permission)->first();
			$check_permission 	= RolePermission::where(['permission_id' => $permission_id->id, 'role_id' => Auth::user()->roles->role_id])->count();
			return ($check_permission == 1) ? true : false;
		} catch (\Throwable $th) {
			Log::error('error on checkPermission in CommanHelper '. $th->getMessage());
		}
	}

	/**
	* Method to get User role
	* 
	* @return string 
	*/
	public static function userRole()
	{
		try {
			if(Auth::user()->roles) {
				return ucfirst(Auth::user()->roles->role->name);
			} else {
				return 'User';
			}
			return 'User';
		} catch (\Throwable $th) {
			Log::error('error on userRole in CommanHelper '. $th->getMessage());
		}
	}

	/**
	 * Method to attach role to user
	 * @param Collection $user
	 * @param Collection $role
	 * @return Collection $user_role
	 */
	public static function attachRole($user, $role)
	{
		try {
			$user_role = UserRole::create(['user_id' => $user->id, 'role_id' => $role->id]);
			return $user_role;
		} catch (\Throwable $th) {
			Log::error('error on userRole in CommanHelper '. $th->getMessage());
		}
	}

	/**
	* Method to get User role by user id
	* @param int $user_id
	* @return string 
	*/
	public static function checkUserRole(int $user_id = 0)
	{
		try {
			$user = User::find($user_id);
			if($user != null) {
				return ucfirst($user->roles->role->name);
			} else {
				return 'User';
			}
			return 'User';
		} catch (\Throwable $th) {
			Log::error('error on userRole in CommanHelper '. $th->getMessage());
		}
	}

	// Your code here!
	public static function SplitTime($StartTime, $EndTime, $a_time, $b_time, $Duration="15", $leaves = array(), $days = array())
	{
		try {
			$ReturnArray = array ();// Define output
			$StartTime    = strtotime ($StartTime); //Get Timestamp
			$EndTime      = strtotime ($EndTime); //Get Timestamp

			$AddMins  = $Duration * 60;

			while ($StartTime <= $EndTime) //Run loop
			{
				if(!in_array(date ("Y-m-d", $StartTime), $leaves) && in_array(date ("l", $StartTime), $days)) {
					if((date ("H:i", $StartTime) >= $a_time) && (date ("H:i", $StartTime) < $b_time)) {
						$ReturnArray[] = date ("d-m-Y G:i", $StartTime);
						$StartTime += $AddMins; //Endtime check
					} else {
						$StartTime += $AddMins; //Endtime check
					}
				} else {
					$StartTime += $AddMins; //Endtime check
				}
			}
			return $ReturnArray;
		} catch (\Throwable $th) {
			Log::error('error on SplitTime in CommanHelper '. $th->getMessage());
		}
	}

	public static function sendSMS($number = '')
	{
		try {
			$curl = curl_init();

			curl_setopt_array($curl, array(
				CURLOPT_URL => "http://2factor.in/API/V1/{".env('TWO_FACTOR')."}/ADDON_SERVICES/SEND/TSMS",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => "{\"From\": \"{SenderId}\",\"To\": \"{8292814411}\", \"Msg\": \"{Hello Nitisj}\", \"SendAt\": \"{}\"}",
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);
			if ($err) {
				echo "cURL Error #:" . $err;
			}
			return json_decode($response, TRUE);
			// if ($err) {
			// 	echo "cURL Error #:" . $err;
			// } else {
			// 	echo $response;
			// }
		} catch (\Throwable $th) {
			Log::error('error on sendSMS in CommanHelper '. $th->getMessage());
		}
	}

	public static function getPhysicalOption(){
        return [
            self::YES => self::YES,
            self::NO => self::NO,
        ];
    }

    public static function getVideoOption(){
        return [
            self::YES => self::YES,
            self::NO => self::NO,
        ];
    }

    
}
