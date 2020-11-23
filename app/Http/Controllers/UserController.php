<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use App\Helpers\CommanHelper;
use App\Models\User;
use App\Models\Role;
use Response;
use Auth;
use Log;

class UserController extends Controller
{
    /**
     * Method to show User registration form
     * @return View
     */
    public function userRegistration()
    {
        try {
            return view('frontend.user.registration');
        } catch(\Exception $e) {
            Log::error("Error in userRegistration on UserController ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Method to create User
     * @return View
     */
    public function createUser(UserRequest $request)
    {
        try {
            $userData = array(
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' => Hash::make($request->password),
                'status' => 'Active',
                'pic' => '',
                'created_at' => date("Y-m-d h:i:s"),
                'updated_at' => date("Y-m-d h:i:s"),
            );
            $user = User::create($userData);

            // Attach role to user
            $user_role = Role::where('name', 'User')->first();
            if($user_role != null) {
                CommanHelper::attachRole($user, $user_role);
            }
            Auth::loginUsingId($user->id);
            return redirect('/');
        } catch(\Exception $e) {
            Log::error("Error in createUser on UserController ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Method to show User Login form
     * @return View
     */
    public function userLogin()
    {
        try {
            return view('frontend.user.login');
        } catch(\Exception $e) {
            Log::error("Error in userLogin on UserController ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Method to show Doctor registration form
     * @return View
     */
    public function doctorRegistration()
    {
        try {
            return view('frontend.doctor.registration');
        } catch(\Exception $e) {
            Log::error("Error in doctorRegistration on UserController ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }
    
    /**
     * Method to show Doctor Login form
     * @return View
     */
    public function doctorLogin()
    {
        try {
            return view('frontend.doctor.login');
        } catch(\Exception $e) {
            Log::error("Error in doctorLogin on UserController ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Method to update user password
     * @return View
     */
    public function updatePassword(UpdatePasswordRequest $request, $user_id = 0)
    {
        try {
            $user = User::find($user_id);
            if($user == null) {
                return back()->with('error', 'User details not found');
            }
            
            if(!\Hash::check($request->old_password, $user->password)) {
                return back()->with('error', 'Old password not match');
            }
            $user->password = Hash::make($request->password);
            $user->save();
            return back()->with('message', 'Password updated successfully.');
        } catch(\Exception $e) {
            Log::error("Error in updatePassword on UserController ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        } 
    }

    /**
     * Method to get all user data
     * @return View
     */
    public function listUsers()
    {
        try {
            $data['users'] = User::join('user_roles', 'users.id', '=', 'user_roles.user_id')->select('users.*')->where('user_roles.role_id', 3)->get();
            return view('UserGroup.list_users', $data);
        } catch(\Exception $e) {
            Log::error("Error in listUsers on UserController ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Method to change User status
     * @param Illuminate\Http\Request $request
     * @return Response array
     * 
     */
    public function changeStatus(Request $request)
    {
        try {
            $user = User::find($request->user_id);
            if($user != null) {
                $user->status = ($request->status == "active") ? 'Active' : 'Inactive';
                $user->save();
                return Response::json(array('status' => true, 'msg' => 'Status changed successfully.'));
            }
            return Response::json(array('status' => false, 'msg' => 'User not found.'));
        } catch(\Exception $e) {
            Log::error("Error in changeStatus on UserController ". $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }

    /**
     * Method to delete User
     * @param int $user_id
     * @return redirect
     */
    public function delete(int $user_id = 0)
    {
        try {
            $user = User::find($user_id);
            if($user == null) { // If details not found then return
                return redirect('users')->with('error', 'Details not found');
            }
            $user->delete();
            return redirect('users')->with('error', 'Record deleted successfully');
        } catch(\Exception $e) {
            Log::error("Error in delete on UserController ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Method to show user log history
     */
    public function logHistory(int $user_id = 0)
    {
        try {
            $data['logs'] = User::find($user_id)->authentications;
            return view('UserGroup.log-history', $data);
        } catch(\Exception $e) {
            Log::error("Error in logHistory on UserController ". $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
    }
}
