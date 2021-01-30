<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Country;
use App\Http\Requests\EditCountry;
use Response;
use Log;


class CountryController extends Controller{
    
    public function import(Request $request){
        $isErrorInFile = null;
        if ($request->all()){
            //validation for import countries starts--
            $validator = Validator::make($request->all(), [
                    'file' => 'required|mimes:csv,txt',
                ],
                [
                'file.required' => 'Please choose csv file.',
                'file.mimes' => 'Uploaded file must be a csv file.',
                'file.size' => 'Uploaded file not be greater than 2mb in size.',
                ]
            );
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
            $data['active'] = 'locations';
            return view('Country.import', $data);
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
        $data['countries'] = Country::get();
        $data['active'] = 'locations';
        return view('Country.index', $data);
    }

    public function edit(int $country_id = 0)
    {
        try {
            $data['country'] = Country::find($country_id);
            if($data['country'] == null) { // If details not found then return
                return redirect()->back()->with('error', 'Details not found');
            }
            $data['active'] = 'locations';
            return view('Country.edit', $data);
        } catch(\Exception $e) {
            Log::error("Error in delete on CountryController ". $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }

    public function update(EditCountry $request, $country_id = 0)
    {
        try {
            $country = Country::find($country_id);
            $country->iso_numeric=$request->dailing_code; 
            $country->name=$request->name;
            $country->iso_alpha_2=$request->iso_alpha_2;
            $country->iso_alpha_3=$request->iso_alpha_3;
            $country->currency_code=$request->currency_code;
            $country->dailing_code=$request->dailing_code;

            if($country == null) { // If details not found then return
                return redirect()->back()->with('error', 'Details not found');
            }
            if($country->save()){
               return redirect('countries')->with('message', 'Record Updated successfully');
            }
             return redirect()->back()->with('error', 'Record Not Updated successfully');
        } catch(\Exception $e) {
            Log::error("Error in delete on CountryController ". $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }
   public function delete(int $country_id = 0)
    {
        try {
            $country = Country::find($country_id);
            if($country == null) { // If details not found then return
                return redirect()->back()->with('error', 'Details not found');
            }
            $country->delete();
            return redirect()->back()->with('error', 'Record deleted successfully');
        } catch(\Exception $e) {
            Log::error("Error in delete on CountryController ". $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }
    public function changeStatus(Request $request)
    {
       try {
            $country = Country::find($request->user_id);
            if($country != null) {
                $country->active = ($request->status == "active") ? 1 : 0;
                $country->save();
                return Response::json(array('status' => true, 'msg' => 'Status changed successfully.'));
            }
            return Response::json(array('status' => false, 'msg' => 'Country not found.'));
        } catch(\Exception $e) {
            Log::error("Error in changeStatus on CountryController ". $e->getMessage());
            return Response::json(array('status' => false, 'msg' => 'Oops! Something went wrong.'));
        }
    }
}