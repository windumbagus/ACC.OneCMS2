<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SurveyExport;

class SurveyController extends Controller
{
    public function index(Request $request)
    {
        $session=[];
        array_push($session,[
            'LoginSession'=>$request->session()->get('LoginSession'),
            'Email'=>$request->session()->get('Email'),
            'Name'=>$request->session()->get('Name'),
            'Id'=>$request->session()->get('Id'),
            'RoleId'=>$request->session()->get('RoleId')
        ]);
         //API GET
         $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/SurveyAPI/GetAllSurvey"; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $Hasils= json_decode($result);
        //  dd($Hasils);

        return view('survey',[
            'Surveys'=>$Hasils,
            'session' => $session            
            ]);    
    }

    public function show(Request $request)
    {
        //API GET
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/SurveyAPI/GetSurveyById?Id=".$request->Id; 
        // dd($url);
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val= json_decode($result);
        // dd($val);

       return json_encode($val);
    }

    public function delete($id=null,Request $request)
    {
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/SurveyAPI/DeleteSurveyById?id=".$id;
        // dd($url);        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $data = json_decode($result);
        // dd($result);

        return redirect('/survey')->with('success',' Delete Data Successfully!');
    }

    public function download()
    {
         //API GET
         $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/SurveyAPI/GetAllSurvey"; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $Hasils= json_decode($result);
        //  dd($Hasils);

         $data=[];
         foreach ($Hasils as $Hasil) {

            
            if (property_exists($Hasil->MstSurveyRating, 'Komentar')){
                $Komentar = $Hasil->MstSurveyRating->Komentar;
            }else{
                $Komentar = "";
            }
            if (property_exists($Hasil->MstSurveyRating, 'Pilihan')){
                $Pilihan = $Hasil->MstSurveyRating->Pilihan;
            }else{
                $Pilihan = "";
            }

           array_push($data,[
               "Id"=>$Hasil->User->Id,
               "Name"=>$Hasil->User->Name,
               "UserName"=>$Hasil->User->Username,
               "Password"=>$Hasil->User->Password,
               "Email"=>$Hasil->User->Email,
               "MobilePhone"=>$Hasil->User->MobilePhone,
               "Creation_Date"=>$Hasil->User->Creation_Date,
               "Last_Login"=>$Hasil->User->Last_Login,
               "Is_Active"=>$Hasil->User->Is_Active,
               "Bintang"=>$Hasil->MstSurveyRating->Bintang,
               "Komentar"=>$Komentar,
               "LastSurveyDate"=>$Hasil->MstSurveyRating->LastSurveyDate,
               "Pilihan"=>$Pilihan,
           ]);
         }
        // dd($data);
        return Excel::download(new SurveyExport($data), 'accone Survey List '. date("Y-m-d") .'.xlsx');
    }
}
