<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserCMSController extends Controller
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
         $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/UserCMSAPI/GetAllUserCMS"; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $Hasils= json_decode($result);
        //  dd($Hasils->User);

        return view('user_cms',[
            'UserCMSs'=>$Hasils->User,
            'Roles'=>$Hasils->Role,
            'UserCategories'=>$Hasils->UserCategory,
            'session' => $session            
            ]);    
    }

    public function show(Request $request)
    {
         //API GET
         $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/UserCMSAPI/GetUser?UserId=".$request->Id; 
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

    // public function update(Request $request)
    // {
    //     // if($request->Is_Active == "on"){
    //     //     $Is_Active = True; 
    //     // }else{
    //     //     $Is_Active = False;
    //     // }

    //     $data = json_encode(array(
    //         "User" => array(   
    //             "Id"=> $request->Id_update,
    //             "Name"=>$request->Name_update,
    //             "Username"=>$request->Username_update,
    //             "Password"=>$request->Password_update,
    //             "Email"=>$request->Emal_update,
    //             "MobilePhone"=>$request->MobilePhone_update,
    //             "External_Id"=>$request->External_Id_update,
    //             "Creation_Date"=>$request->Creation_Date_update,
    //             "Last_Login"=>$request->Last_Login_update,
    //             "Is_Active"=>$request->Is_Active_update,
    //         ),
    //         "UserDetail" => array(
    //             "Id"=>$request->,
    //             "UserId"=>$request->,
    //             "RoleId"=>$request->,
    //             "UserCategory"=>$request->,
    //             "IsSuperAdmin"=>$request->,
    //             "AddedDate"=>$request->,
    //             "UserAdded"=>$request->,
    //             "UpdatedDate"=>$request->,
    //             "UserUpdated"=>$request->,
    //             "Status"=>$request->,
    //             "Organization"=>$request->,
    //             "NPK"=>$request->,
    //             "ExpiredDate"=>$request->,
    //             "Address"=>$request->,
    //             "Supplier"=>
    //         ),
    //     )); 
    //     // dd($data);
    //     $url = ""; 
    //     $ch = curl_init($url);                   
    //     curl_setopt($ch, CURLOPT_POST, true);                                  
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
    //     $result = curl_exec($ch);
    //     $err = curl_error($ch);
    //     curl_close($ch);
    //     $Hasils= json_decode($result); 
    //     // dd($Hasils);
    //         return redirect("user-cms")->with('success','Data User CMS Update Successfull !!!');
    // }
}
