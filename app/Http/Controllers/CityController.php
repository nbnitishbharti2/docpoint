<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\City;
use App\Http\Requests\EditCity;
use Response;
use Log;

class CityController extends Controller{
    
   public function import(Request $request,$countryid,$stateid){
      $isErrorInFile = null;
      if ($request->all()){
         //validation for import countries starts--
         $validator = Validator::make($request->all(), [
         // 'file' => 'required|size:2097152|mimes:csv,txt',
             'file' => 'required|mimes:csv,txt',
            ],[
               'file.required' => 'Please choose csv file.',
               'file.mimes' => 'Uploaded file must be a csv file.',
               'file.size' => 'Uploaded file not be greater than 2mb in size.',
         ]);
         $validator->validate();
         //validation for add countries ends--
         $file = $request->file('file');
         $filename = $file->getClientOriginalName();
         $location = 'uploads';
         $file->move($location,$filename);
         $filepath = public_path($location."/".$filename);
         $file = fopen($filepath,"r");
         $importData_arr = array();
         $i = 0;
         while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
            $num = count($filedata );
            // Skip first row (Remove below comment if you want to skip the first row)
            if($i == 0){
               $i++;
               continue; 
            }
            for ($c=0; $c < $num; $c++) {
               $importData_arr[$i][] = $filedata [$c];
            }
            $i++;
         }
         // Insert to MySQL database
         $j=0;
         foreach($importData_arr as $importData){
            $insertDatas[$j] = array(
               "name"=>$importData[0],
               "active"=>$importData[1],
               "country_id"=>$countryid,
               "state_id"=>$stateid,
               "alias"=> (!empty($importData[0])) ? (str_replace(" ","-",strtolower($importData[0]))) : '',
               'created_at' => date("Y-m-d h:i:s"),
               'updated_at' => date("Y-m-d h:i:s"),
            );
            //validation row wise starts--
            $errMsg = '';
            $errMsg = empty($importData[0]) ? "city name is mandatory,": '';
            $errMsg .= empty($importData[1]) ? "active is mandatory,":'';
            $errMsg .= ((!empty($importData[1]) && ($importData[1] != "yes"))) && (!empty($importData[1]) && ($importData[1] != "no")) ? 'active should be yes or no' : '';
            if(!empty($errMsg)){
               $isErrorInFile = 1;
               $insertDatas[$j]['errors'] = $errMsg;
            }
            //validation row wise ends--
            $j++;
         }
         //export data starts--
         if($isErrorInFile){
            $f = fopen('php://memory', 'w'); 
            $heading = array('name','active','errors');
            array_unshift($insertDatas,$heading);
            foreach ($insertDatas as $line) { 
               unset($line['created_at'], $line['updated_at'], $line['alias'], $line['country_id'],$line['state_id']);
               fputcsv($f, $line, ","); 
            }
            fseek($f, 0);
            header('Content-Type: application/csv');
            header('Content-Disposition: attachment; filename="'.$filename.'";');
            fpassthru($f);//export data ends--
         }else{
            foreach($insertDatas as $insertData){
               $insertData['active'] = $insertData['active'] == "yes" ? 1:0;
               DB::table('cities')
               ->updateOrInsert(
               ['name' => $insertData['name']],
               $insertData
            );
            }
            Session::flash('alert-success', 'Cities added successfully');
            return view('city.import',['countryid'=>$countryid,'stateid'=>$stateid]);
         }
         
      } else{
         $data['active'] = 'locations';
         $data['countryid'] = $countryid;
         $data['stateid'] = $stateid;
         return view('City.import', $data);
      }
   }

   public function export($countryid,$stateid){
        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=cities.csv");
        $output = fopen("php://output", "wb");
        $cities = DB::table('cities')->where([['country_id',$countryid],['state_id',$stateid]])->select('name','active')->get()->toArray();
        $heading = array('name','active');
        array_unshift($cities,$heading);
        $i=0;
        foreach ($cities as $row){
            $row = (array)$row;
            if($i != 0){
                $row['active'] = $row['active'] == 1? "yes":"no";
            }   
           fputcsv($output, $row); // here you can change delimiter/enclosure
           $i++;
        }
      fclose($output);
   }

   public function index($countryid,$stateid){
      $cityData = City::where([['country_id',$countryid],['state_id',$stateid]])->get();
      $data['active'] = 'locations';
      $data['country_id'] = $countryid;
      $data['state_id'] = $stateid;
      $data['data'] = $cityData;
      return view('City.index', $data);
   }

 public function edit(int $city_id = 0)
    {
        try {
            $data['data'] = City::find($city_id);
            if($data['data'] == null) { // If details not found then return
               return redirect()->back()->with('error', 'Details not found');
            }
            $data['active'] = 'locations';
            return view('City.edit', $data);
        } catch(\Exception $e) {
            Log::error("Error in delete on CityController ". $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }
    public function update(EditCity $request, $city_id = 0)
    { 
        try {
            $city = City::find($city_id);
            $city->name=$request->name;
            $city->alias= str_replace(" ","-",strtolower($request->name));
            if($city == null) { // If details not found then return
                return redirect()->back()->with('error', 'Details not found');
            }
            if($city->save()){
               return redirect('cities/'.$city->country_id.'/'.$city->state_id)->with('message', 'Record Updated successfully');
            }
             return redirect()->back()->with('error', 'Record Not Updated successfully');
        } catch(\Exception $e) {
            Log::error("Error in delete on CityController ". $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }
   /**
    * Method to get all cities of states
    * @param Illuminate\Http\Request $request
    * @return Collection $cities
    */
    public function getCityOfState(Request $request)
    {
       try {
          $cities = City::where('state_id', $request->state_id)->pluck('name', 'id' );
          return $cities;
       } catch(\Exception $e) {
          Log::error("Error in getCityOfState on StateController ". $e->getMessage());
       }
    }
    public function delete(int $city_id = 0)
    {
        try {
            $city = City::find($city_id);
            if($city == null) { // If details not found then return
                return redirect()->back()->with('error', 'Details not found');
            }
            $city->delete();
            return redirect()->back()->with('error', 'Record deleted successfully');
        } catch(\Exception $e) {
            Log::error("Error in delete on CityController ". $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }
    public function changeStatus(Request $request)
    {
       try {
            $city = City::find($request->user_id);
            if($city != null) {
                $city->active = ($request->status == "active") ? 1 : 0;
                $city->save();
                return Response::json(array('status' => true, 'msg' => 'Status changed successfully.'));
            }
            return Response::json(array('status' => false, 'msg' => 'City not found.'));
        } catch(\Exception $e) {
            Log::error("Error in changeStatus on CityController ". $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }
}

   

