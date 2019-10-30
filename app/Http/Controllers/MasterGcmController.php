<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterGcmController extends Controller
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
            'SubMenuId'=>"3" // "3" untuk SubMenu MasterContent

        ]);
        
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterGcmAPI/GetAllMasterGcmByCondition?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val = json_decode($result);
        // dd($val);

        if(property_exists($val,"IsSuccess")){
            return view(
                'master_gcm',[
                    'Conditions'=> $val->Data->Condition,
                    'session' => $session
            ]);
        }else{
            return redirect('/invalid-permission');
        }
    }

    public function getByCondition(Request $request)
    {
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterGcmAPI/GetAllMasterGcmByCondition?Condition=".urlencode($request->Condition); 
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val = json_decode($result);
        // dd($val);

        return json_encode($val->Data); 
    }

    public function delete(Request $request)
    {
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterGcmAPI/DeleteMasterGcmById?MstGCMId=".$request->Id;
        // dd($url);        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val = json_decode($result);
        // dd($result);
        return json_encode($val);
    }

    public function show(Request $request)
    {
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterGcmAPI/GetMasterGcmById?MstGCMId=".$request->Id; 
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val = json_decode($result);
        // dd($val);

        return json_encode($val); 
    }
}
