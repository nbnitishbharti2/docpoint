<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Session;
use Illuminate\Support\Facades\DB;


class CountryController extends Controller{
    
   public function import(Request $request){
      $isErrorInFile = null;
      if ($request->all()){
         //validation for import countries starts--
         $validator = Validator::make($request->all(), [
          'file' => 'required|mimes:csv,txt',
//          'file' => 'required|size:2097152|mimes:csv,txt',
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
         foreach($importData_arr as $importData){
            $insertDatas[$j] = array(
               "name"=>$importData[0],
               "iso_alpha_2"=>$importData[1],
               "iso_alpha_3"=>$importData[2],
               "iso_numeric"=>$importData[3],
               "currency_code"=>$importData[4],
               "dailing_code"=>$importData[5],
               "active"=>$importData[6],
               'created_at' => date("Y-m-d h:i:s"),
               'updated_at' => date("Y-m-d h:i:s"),
            );
            //validation row wise starts--
            $errMsg = '';
            $errMsg = empty($importData[0]) ? "country name is mandatory,": '';
            $errMsg .= empty($importData[1]) ? "iso_alpha_2 is mandatory,":'';
            $errMsg .= empty($importData[2]) ? "iso_alpha_3 is mandatory," : '';
            $errMsg .= (!empty($importData[1]) && (strlen($importData[1]) !=2)) ? "iso_alpha_2 should be 2 character long," : '';
            $errMsg .= (!empty($importData[1]) && (strlen($importData[2]) !=3)) ? "iso_alpha_3 should be 3 character long," : '';
            $errMsg .= empty($importData[6]) ? "active is mandatory,":'';
            $errMsg .= ((!empty($importData[6]) && ($importData[6] != "yes"))) && (!empty($importData[6]) && ($importData[6] != "no")) ? 'active should be yes or no' : '';
            dd($errMsg);
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
            $heading = array('name','iso_alpha_2','iso_alpha_3','iso_numeric','currency_code','dailing_code','active','errors');
            array_unshift($insertDatas,$heading);
            foreach ($insertDatas as $line) { 
               unset($line['created_at']);
               unset($line['updated_at']);
               fputcsv($f, $line, ","); 
            }
            fseek($f, 0);
            header('Content-Type: application/csv');
            header('Content-Disposition: attachment; filename="'.$filename.'";');
            fpassthru($f);//export data ends--
         }else{
            foreach($insertDatas as $insertData){
              $insertData['active'] = $insertData['active'] == "yes" ? 1:0;
               DB::table('countries')
               ->updateOrInsert(
               ['name' => $insertData['name']],
               $insertData
            );
            }
            Session::flash('alert-success', 'Countries added successfully');
            return redirect('/countries');
         }
         
      } else{
        return view('Country.import');
        }
   }

   public function export(){
      header("Content-Type: text/csv");
      header("Content-Disposition: attachment; filename=country.csv");
      $output = fopen("php://output", "wb");
      $countries = DB::table('countries')->select('name','iso_alpha_2','iso_alpha_3','iso_numeric','currency_code','dailing_code','active')->get()->toArray();
      $heading = array('name','iso_alpha_2','iso_alpha_3','iso_numeric','currency_code','dailing_code','active');
      array_unshift($countries,$heading);
      $i=0;
      foreach ($countries as $row){
        $row = (array)$row;
        if($i != 0){
            $row['active'] = $row['active'] == 1? "yes":"no";
        }
        fputcsv($output, $row); // here you can change delimiter/enclosure
        $i++;
      }
      fclose($output);
   }

   public function index(){
      $countryData = DB::table('countries')->get();
      return view('Country.index',['data' => $countryData]);
   }


}

   

