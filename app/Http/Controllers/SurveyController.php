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
            'RoleId'=>$request->session()->get('RoleId'),
            'SubMenuId'=>"30" // "30" untuk SubMenu Survey

        ]);
         //API GET
         $url = config('global.base_url_outsystems')."/ACCWorldCMS/rest/SurveyAPI/GetAllSurvey?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $Hasils= json_decode($result);
        //  dd($Hasils);
   
        if((property_exists($Hasils,"Role")) && ($Hasils->Role->IsView == True)){
            return view(
                'survey',[
                    'Role' => $Hasils->Role,
                    'Surveys'=>$Hasils->Data, 
                    'session' => $session
                ]);
        }else{
            return redirect('/invalid-permission');
        }  
    }

    public function show(Request $request)
    {
        //API GET
        $url = config('global.base_url_outsystems')."/ACCWorldCMS/rest/SurveyAPI/GetSurveyById?Id=".$request->Id; 
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
        $url = config('global.base_url_outsystems')."/ACCWorldCMS/rest/SurveyAPI/DeleteSurveyById?id=".$id;
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

    public function download(Request $request)
    {
        $session=[];
        array_push($session,[
            'LoginSession'=>$request->session()->get('LoginSession'),
            'Email'=>$request->session()->get('Email'),
            'Name'=>$request->session()->get('Name'),
            'Id'=>$request->session()->get('Id'),
            'RoleId'=>$request->session()->get('RoleId'),
            'SubMenuId'=>"30" // "30" untuk SubMenu Survey

        ]);
        //API GET
        $url = config('global.base_url_outsystems')."/ACCWorldCMS/rest/SurveyAPI/GetAllSurvey?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"];
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasils= json_decode($result);
        // dd($Hasils);

        $data=[];
        foreach ($Hasils->Data as $Hasil) {
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
            if (property_exists($Hasil->User, 'Name')){
                $User_Name = $Hasil->User->Name;
            }else{
                $User_Name = "";
            }
            if (property_exists($Hasil->User, 'Username')){
                $User_Username = $Hasil->User->Username;
            }else{
                $User_Username = "";
            }
            if (property_exists($Hasil->User, 'Email')){
                $User_Email = $Hasil->User->Email;
            }else{
                $User_Email = "";
            }
            if (property_exists($Hasil->User, 'MobilePhone')){
                $User_MobilePhone = $Hasil->User->MobilePhone;
            }else{
                $User_MobilePhone = "";
            }
            if (property_exists($Hasil->User, 'Password')){
                $User_Password = $Hasil->User->Password;
            }else{
                $User_Password = "";
            }
            if (property_exists($Hasil->User, 'Last_Login')){
                $User_Last_Login = $Hasil->User->Last_Login;
            }else{
                $User_Last_Login = "";
            }
            if (property_exists($Hasil->User, 'Is_Active')){
                $User_Is_Active = $Hasil->User->Is_Active;
            }else{
                $User_Is_Active = "";
            }
            if (property_exists($Hasil->User, 'Creation_Date')){
                $User_Creation_Date = $Hasil->User->Creation_Date;
            }else{
                $User_Creation_Date = "";
            }

            array_push($data,[
                "Id"=>$Hasil->User->Id,
                "Name"=>$User_Name,
                "UserName"=>$User_Username,
                "Password"=>$User_Password,
                "Email"=>$User_Email,
                "MobilePhone"=>$User_MobilePhone,
                "Creation_Date"=>$User_Creation_Date,
                "Last_Login"=>$User_Last_Login,
                "Is_Active"=>$User_Is_Active,
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
