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

    public function add(Request $request)
    {
        // $request->validate([
        //     "CD_BRAND_master_otr_add"=>'required',         
        // ]);

        if (property_exists($request, 'file')){
            $file = $request->Input_Picture_Add;
            $getContent = file_get_contents($file);
            $content= base64_encode($getContent);
            $name = $file->getClientOriginalName();
            $filetype = $file->extension();

            $filetype = "image/".$filetype;
            $type = "MasterGCM";
        }else{
            $content ="";
            $name="";
            $type="";
            $filetype="";
        }
        
        if($request->IsActive_Add== "on"){
            $IsActive_Add = "Y";
        }else{
            $IsActive_Add = "N";
        }

        $data = json_encode(array(
            "MstPicture" => array(   
                // "Id" => ,
                // "DataId" => $request->Id,
                "Picture" => $content,
                "FileName" => $name,
                "FileType" => $filetype,
                "Type" => $type,
            ),
            "MstGCM" => array(
                // "Id" => ,
                "Condition" => $request->Condition_Add,
                "CharValue1" => $request->CharValue1_Add,
                "CharDesc1" => $request->CharDesc1_Add,
                "CharValue2" => $request->CharValue2_Add,
                "CharDesc2" => $request->CharDesc2_Add,
                "CharValue3" => $request->CharValue3_Add,
                "CharDesc3" => $request->CharDesc3_Add,
                "CharValue4" => $request->CharValue4_Add,
                "CharDesc4" => $request->CharDesc4_Add,
                "CharValue5" => $request->CharValue5_Add,
                "CharDesc5" => $request->CharDesc5_Add,
                "AddedDate" => now(),
                "UserAdded" => $request->session()->get('Id'),
                // "UpdatedDate" => $request->,
                // "UserUpdated" => $request->,
                "IsActive" => $IsActive_Add,
                // "TimeStamp1" => $request->TimeStamp1_Add,
                // "TimeStamp2" => $request->TimeStamp2_Add,
            ),
            "User_Username" =>  $request->session()->get('Id'),
            "MstGCM_TimeStamp1" => $request->TimeStamp1_Add,
            "MstGCM_TimeStamp2" => $request->TimeStamp2_Add,

        ));
        // dd($data);

        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterGcmAPI/CreateOrUpdateMasterGcm"; 
        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $hasils = json_decode($result);
        // dd($result);

        return redirect('/master-gcm')->with('success','Master GCM Successfully Added !!!');
    }
}
