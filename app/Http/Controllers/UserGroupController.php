<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserGroupController extends Controller
{
    

   public function index(){
      return view('UserGroup.index',['data' => DB::table('user_groups')->get()]);
   }

   public function add(Request $request) {
      if ($request->all()) {
          $input = $request->all();
          unset($input['_token']);
          $input['alias_name'] = str_replace(" ","-",strtolower($input['name']));
          $input['active'] = ($input['active'] == 'on') ? 1 : 0;
          $input['created_at'] = date("Y-m-d h:i:s");
          $input['updated_at'] = date("Y-m-d h:i:s");
          DB::table('user_groups')->insert($input);
          Session::flash('alert-success', 'User Group added successfully');
          return redirect('/user_groups');
      } 
      return view('UserGroup.add');
   }
}

   

