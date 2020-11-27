<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Helpers\CommanHelper;
use Log;

/**
 * AuthCotroller responsible for login authentication and default session writing.
 * @author Chetan Jha
 */
class AuthController extends Controller
{
    /**
     * method for redirect user according to roles
     * 
     * @return redirect
     */
    public function authenticateUserAndRedirect()
    {    
        try {
            if (Auth::check()) {
                $userData = Auth::user();
                if($userData->status == 'Active') { // If user is not active
                    $userRole = CommanHelper::userRole();
                    if($userRole == "Admin") {
                        return redirect('/dashboard');
                    } elseif ($userRole == "Doctor") {
                        return redirect('/dashboard');
                    } else {
                        return redirect('/');
                    }
                } else {
                    Auth::logout();
                    return redirect('/login')->with('error', 'Your user account is Inactive.');
                }
            }
            return redirect('/');
        } catch (\Exception $e) {
            Log::error('Error in authenticateUserAndRedirect on AuthController '. $e->getMessage());
        }
    }
}
