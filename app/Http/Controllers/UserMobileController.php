<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserMobileExport;

class UserMobileController extends Controller
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
            'SubMenuId'=>"7" // "7" untuk SubMenu UserMobile
        ]);
         //API GET
         $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/UserMobileAPI/GetAllUser?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $Hasils= json_decode($result);
        //  dd($Hasils);

        if(property_exists($Hasils,"IsSuccess")){
            return view(
                'user_mobile',[
                    'UserMobiles'=>$Hasils->Data, 
                    'session' => $session
            ]);
        }else{
            return redirect('/invalid-permission');
        }  
    }

    public function show(Request $request)
    {
        //API GET
         $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/UserMobileAPI/GetUser?UserId=".$request->Id; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $val= json_decode($result);
        //  dd($val);

        return json_encode($val);
    }

    public function update(Request $request)
    {
        if($request->Is_Active == "on"){
            $Is_Active = True; 
        }else{
            $Is_Active = False;
        }

        $data = json_encode(array(
            "Id"=>$request->Id,
            "Name"=> $request->Name,
            "Username"=> $request->Username,
            "Password"=> $request->Password,
            "Email"=> $request->Email,
            "MobilePhone"=> $request->MobilePhone,
            "External_Id"=> $request->External_Id,
            "Creation_Date"=> $request->Creation_Date,
            "Last_Login"=> $request->LastLogin,
            "Is_Active"=>$Is_Active
            )); 
        // dd($data);
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/UserMobileAPI/UpdateUser"; 
        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasils= json_decode($result); 
        // dd($Hasils);
            return redirect("user-mobile")->with('success','Data User Mobile Update Successfull !!!');
    }

    public function download(Request $request)
    {
         //API GET
         $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/UserMobileAPI/GetAllUser"; 
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

           
           if (property_exists($Hasil->User, 'Username')){
               $Username= $Hasil->User->Username;
           }else{
               $Username= "";
           }
           if (property_exists($Hasil->User, 'Email')){
                $Email= $Hasil->User->Email;
            }else{
                $Email= "";
            }

            if (property_exists($Hasil->User, 'MobilePhone')){
                $MobilePhone= $Hasil->User->MobilePhone;
            }else{
                $MobilePhone= "";
            }

            if (property_exists($Hasil->User, 'NamaNIK')){
                $NamaNIK= $Hasil->User->NamaNIK;
            }else{
                $NamaNIK= "";
            }

            if (property_exists($Hasil->MstCustomerDetail, 'StatusNoHP')){
                $StatusNoHP= $Hasil->MstCustomerDetail->StatusNoHP;
            }else{
                $StatusNoHP= "FALSE";
            }

            if (property_exists($Hasil->MstCustomerDetail, 'Subscribe')){
                $Subscribe= $Hasil->MstCustomerDetail->Subscribe;
            }else{
                $Subscribe= "N";
            }

            if (property_exists($Hasil->MstCustomerDetail, 'Job')){
                $Job= $Hasil->MstCustomerDetail->Job;
            }else{
                $Job= "";
            }

            if (property_exists($Hasil->User, 'Last_Login')){
                $Last_Login= $Hasil->User->Last_Login;
            }else{
                $Last_Login= "";
            }

            if (property_exists($Hasil->User, 'Name')){
                $Name= $Hasil->User->Name;
            }else{
                $Name= "";
            }
 
            if(property_exists($Hasil, 'MstStatus')){
                if (property_exists($Hasil->MstStatus, 'Label')){
                    $Label= $Hasil->MstStatus->Label;
                }else{
                    $Label= "";
                }
            }else{
                $Label= "";
            }

          array_push($data,[
              "Name"=>$Name,
              "Username"=>$Username,
              "Email"=>$Email,
              "MobilePhone"=>$MobilePhone,
              "Is_Active"=>$Hasil->User->Is_Active,
              "NamaNIK"=>$NamaNIK,
              "TanggalLahir"=>$Hasil->MstCustomerDetail->TanggalLahir,
              "Alamat"=>$Hasil->MstCustomerDetail->Alamat,
              "Status"=>$Label,
              "StatusNoHP"=>$StatusNoHP,
              "Subscribe"=>$Subscribe,
              "Job"=>$Job,
              "Last_Login"=>$Last_Login
          ]);
        }
       // dd($data);
       return Excel::download(new UserMobileExport($data), 'accone User Mobile '. date("Y-m-d") .'.xlsx');

    }
}
