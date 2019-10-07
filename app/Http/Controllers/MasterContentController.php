<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterContentController extends Controller
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
        
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterContentAPI/GetMasterContentByContentType"; 
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val = json_decode($result);
        // dd($val);

        return view('master_content',[
            'MstGCM_ContentTypeList'=> $val->MstGCM->ContentType,
            'MstGCM_ContentStatusList'=> $val->MstGCM->ContentStatus,
            'MstGCM_NewsCategoryList'=> $val->MstGCM->NewsCategory,
            'session'=> $session            
        ]);  
    }
    
    public function getByContentType(Request $request)
    {
        $session=[];
        array_push($session,[
            'LoginSession'=>$request->session()->get('LoginSession'),
            'Email'=>$request->session()->get('Email'),
            'Name'=>$request->session()->get('Name'),
            'Id'=>$request->session()->get('Id'),
            'RoleId'=>$request->session()->get('RoleId')
        ]);
        
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterContentAPI/GetMasterContentByContentType?MstGCM_ContentType=".urlencode($request->ContentType); 
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

    public function show(Request $request)
    {
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterContentAPI/ViewMasterContentById?MstContent_Id=".$request->Id; 
        $ch = curl_init($url);                                                     
        //  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val= json_decode($result);
        // dd($val);

        return json_encode($val);
    }

    public function delete(Request $request)
    {
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterContentAPI/DeleteMasterContentById?MstContent_Id=".$request->Id;
        // dd($url);        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val = json_decode($result);
        // dd($val);

        return json_encode($val);
    }

    public function create(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'addMasterContent_MstPicture' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect('/master-content')->with('error',' Upload Picture Failed!');
        }
        $file = $request->addMasterContent_MstPicture;
        $getContent = file_get_contents($file);
        $content= base64_encode($getContent);
        $name = $file->getClientOriginalName();
        $type = $file->extension();
        
        $data = json_encode(array(
            "MstContent" => array(   

            ),
            "MstPicture" => array(
                // "Id" => "$request->updatePromo_MstPicture_Id",
                // "DataId" => "$request->updatePromo_MstPicture_DataId",
                "Type" => "Promo",
                "Picture" => $content,
                "FileName" => $name,
                "FileType" => "image/".$type,
            ),
        )); 
        // dd($data);

        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterContentAPI/CreateOrUpdateMasterContent"; 
        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $val = json_decode($result);
        // dd($val);

        if(property_exists($val, 'Success') && ($val->Success)) {
            return redirect('/master-content')->with('success',' Add Data Successfully!');
        } elseif(property_exists($val, 'Error')) {
            return redirect('/master-content')->with('error', $val->Error);
        } elseif(property_exists($val, 'Errors')) {
            return redirect('/master-content')->with('error', $val->Errors);
        } else {
            return redirect('/master-content')->with('error',' Add Data Failed!');
        }
    }
}
