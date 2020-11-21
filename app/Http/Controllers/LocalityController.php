<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Location;
use App\Http\Requests\EditLocation;
use Response;
use Log;

class LocalityController extends Controller{
    
   public function import(Request $request,$countryid,$stateid,$cityid){
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
               "pincode"=>$importData[1],
               "active"=>$importData[2],
               "state_id"=>$stateid,
               "city_id"=>$cityid,
               "country_id"=>$countryid,
               'created_at' => date("Y-m-d h:i:s"),
               'updated_at' => date("Y-m-d h:i:s"),
            );
            //validation row wise starts--
            $errMsg = '';
            $errMsg = empty($importData[0]) ? "locality name is mandatory,": '';
            $errMsg = empty($importData[1]) ? "pincode is mandatory,": '';
            $errMsg .= empty($importData[2]) ? "active is mandatory,":'';
            $errMsg .= ((!empty($importData[2]) && ($importData[2] != "yes"))) && (!empty($importData[2]) && ($importData[2] != "no")) ? 'active should be yes or no' : '';
            $errMsg = !empty($importData[1] && (!is_numeric($importData[1]))) ? "pincode should be numeric,": '';
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
            $heading = array('name','pincode','active','errors');
            array_unshift($insertDatas,$heading);
            foreach ($insertDatas as $line) { 
               unset($line['created_at'], $line['updated_at'], $line['alias'], $line['country_id'],$line['state_id'],$line['city_id']);
               fputcsv($f, $line, ","); 
            }
            fseek($f, 0);
            header('Content-Type: application/csv');
            header('Content-Disposition: attachment; filename="'.$filename.'";');
            fpassthru($f);//export data ends--
         }else{
            foreach($insertDatas as $insertData){
               $insertData['active'] = $insertData['active'] == "yes" ? 1:0;
               Location::updateOrInsert(
               ['name' => $insertData['name']],
               $insertData
            );
            }
            Session::flash('alert-success', 'Localities added successfully');
            return view('locality.import',['countryid'=>$countryid,'stateid'=>$stateid,'cityid'=>$cityid]);
         }
         
      } else{
            return view('Locality.import',['countryid'=>$countryid,'stateid'=>$stateid,'cityid'=>$cityid]);
        }
   }

   public function export($countryid,$stateid,$cityId){
        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=localities.csv");
        $output = fopen("php://output", "wb");
        $localities = Location::where([['country_id',$countryid],['state_id',$stateid],['city_id',$cityId]])->select('name','pincode','active')->get()->toArray();
        $heading = array('name','pincode','active');
        array_unshift($localities,$heading);
        $i=0;
        foreach ($localities as $row){
            $row = (array)$row;
            if($i != 0){
                $row['active'] = $row['active'] == 1? "yes":"no";
            } 
           fputcsv($output, $row); // here you can change delimiter/enclosure
           $i++;
        }
        fclose($output);
   }

   public function index($countryid,$stateid,$cityId){
      $localityData = Location::where([['country_id',$countryid],['state_id',$stateid],['city_id',$cityId]])->select('id','name','pincode','active')->get();
      return view('Locality.index',['data' => $localityData]);
   }
   public function edit(int $country_id = 0)
    {
        try {
            $location = Location::find($country_id);
            if($location == null) { // If details not found then return
                return redirect()->back()->with('error', 'Details not found');
            }
            return view('Locality.edit',['data' => $location]);
        } catch(\Exception $e) {
            Log::error("Error in delete on LocationController ". $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }
    public function update(EditLocation $request, $country_id = 0)
    {

        try {
            $location = Location::find($country_id);
            $location->pincode=$request->pincode; 
            $location->name=$request->name; 
            if($location == null) { // If details not found then return
                return redirect()->back()->with('error', 'Details not found');
            }
            if($location->save()){
               return redirect('locality-index/'.$location->country_id.'/'.$location->state_id.'/'.$location->city_id)->with('message', 'Record Updated successfully');
            }
             return redirect()->back()->with('error', 'Record Not Updated successfully');
        } catch(\Exception $e) {
            Log::error("Error in delete on LocationController ". $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }
    public function delete(int $country_id = 0)
    {
        try {
            $location = Location::find($country_id);
            if($location == null) { // If details not found then return
                return redirect()->back()->with('error', 'Details not found');
            }
            $location->delete();
            return redirect()->back()->with('error', 'Record deleted successfully');
        } catch(\Exception $e) {
            Log::error("Error in delete on LocationController ". $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }
    public function changeStatus(Request $request)
    {
       try {
            $location = Location::find($request->user_id);
            if($location != null) {
                $location->active = ($request->status == "active") ? 1 : 0;
                $location->save();
                return Response::json(array('status' => true, 'msg' => 'Status changed successfully.'));
            }
            return Response::json(array('status' => false, 'msg' => 'Location not found.'));
        } catch(\Exception $e) {
            Log::error("Error in changeStatus on LocationController ". $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }


}

   

