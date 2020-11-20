<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\State;
use Log;

class StateController extends Controller{
    
   public function import(Request $request,$id){
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
         $j=1;
         //dd($importData_arr);
         foreach($importData_arr as $importData){
            $insertDatas[$j] = array(
               "name"=>$importData[0],
               "active"=>$importData[1],
               "country_id"=>$id,
               "alias"=> (!empty($importData[0])) ? (str_replace(" ","-",strtolower($importData[0]))) : '',
               'created_at' => date("Y-m-d h:i:s"),
               'updated_at' => date("Y-m-d h:i:s"),
            );
            //validation row wise starts--
            $errMsg = '';
            //svar_dump($importData[1]);
            $errMsg = empty($importData[0]) ? "state name is mandatory,": '';
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
               unset($line['created_at'], $line['updated_at'], $line['alias'], $line['country_id']);
               fputcsv($f, $line, ","); 
            }
            fseek($f, 0);
            header('Content-Type: application/csv');
            header('Content-Disposition: attachment; filename="'.$filename.'";');
            fpassthru($f);//export data ends--
         }else{
            foreach($insertDatas as $insertData){
               $insertData['active'] = $insertData['active'] == "yes" ? 1:0;
               DB::table('states')
               ->updateOrInsert(
               ['name' => $insertData['name']],
               $insertData
            );
            }
            Session::flash('alert-success', 'Sttates added successfully');
            return view('state.import',['id'=>$id]);
         }
         
      } else{
        return view('State.import',['id'=>$id]);
        }
   }

   public function export($id){
      header("Content-Type: text/csv");
      header("Content-Disposition: attachment; filename=states.csv");
      $output = fopen("php://output", "wb");
      $states = DB::table('states')->select('name','active')->where('country_id',$id)->get()->toArray();
      $heading = array('name','active');
      array_unshift($states,$heading);
      $i=0;
      foreach ($states as $row){
        $row = (array)$row;
        if($i != 0){
            $row['active'] = $row['active'] == 1? "yes":"no";
        }
        fputcsv($output, $row); // here you can change delimiter/enclosure
        $i++;
      }
      fclose($output);
   }

   public function index($id){
      $stateData = DB::table('states')->where('country_id',$id)->get();
      return view('State.index',['data' => $stateData,'id'=>$id]);
   }

   /**
    * Method to get all states of country
    * @param Illuminate\Http\Request $request
    * @return Collection $states
    */
   public function getStateOfCountry(Request $request)
   {
      try {
         $states = State::where('country_id', $request->country_id)->pluck('name', 'id' );
         return $states;
      } catch(\Exception $e) {
         Log::error("Error in getStateOfCountry on StateController ". $e->getMessage());
      }
   }


}

   

