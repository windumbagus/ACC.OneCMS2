<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditGcmAccessController extends Controller
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
        
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterGcmAPI/GetAllMstGcmAccess"; 
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasils = json_decode($result);
        // dd($Hasils);

        return view('/modal/edit_gcm_access',[
            'GcmAccesss'=> $Hasils,
            'session' => $session
        ]);
    }

    public function OnChangeAccWorld($Id=null, $Condition= null,$AccWorld=null, Request $request)
    {
        if($AccWorld == 1){
            $AccWorld = "true";
        }else if($AccWorld == 0){
            $AccWorld = "false";
        }

        //API GET
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterGcmAPI/OnChangeBidmart?MstGCMAccess_Id=".$Id."&MstGCMAccess_Condition=".$Condition."&MstGCMAccess_AccWorld=".$AccWorld; 
        // dd($url);
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val = json_decode($result);

        return json_encode($val);
    }

}
