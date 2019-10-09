<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            'RoleId'=>$request->session()->get('RoleId')
        ]);
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

        return view('user_mobile',[
            'UserMobiles'=>$Hasils,
            'session' => $session            
            ]);    
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
}
