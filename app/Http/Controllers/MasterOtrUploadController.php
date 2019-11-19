<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterOtrUploadController extends Controller
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
         //API GET MstOTR
         $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterOtrAPI/GetTmpOTRUpload"; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $Hasils= json_decode($result);
        //  dd($Hasils);

        return view('modal/upload_master_otr',[
            'TmpOTRs'=>$Hasils,
            'session' => $session                        
            ]);    
    }

    public function upload(Request $request)
    {
        $request->validate([
            'upload_master_otr' => 'required',
        ]);

        $file = $request->upload_master_otr;
        $x= file_get_contents($file);
        $y= base64_encode($x);

        $name = $file->getClientOriginalName();
        $data = json_encode(array(
            "Filename" => "$name",
            "Content" => $y,
        ));
        // dd($data);  

        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterOtrAPI/UploadMasterOtr"; 
        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasils = json_decode($result);
        // dd($Hasils);
        if(property_exists($Hasils, 'Success')){
            return redirect('/master-otr/upload-page')->with('success','Data Master Otr Upload Successfull !!!');
        }else{
            return redirect('/master-otr/upload-page')->with('warning', $Hasils->ErrorMessage);
        }
    }

    public function cancel(Request $request)
    {
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterOtrAPI/UploadCancelMstTmpOtr"; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);

        return redirect('/master-otr');

    }

    public function proceed(Request $request)
    {
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/MasterOtrAPI/UploadProceedMstOtr"; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);

        return redirect('/master-otr/upload-page');

    }

    // public function OnChangeIsAlreadyUse($Id=null, Request $request)
    // { 
    //     //API GET
    //     $url = "https://acc-dev1.outsystemsenterprise.com/".$Id; 
    //     // dd($url);
    //     $ch = curl_init($url);                                                     
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
    //     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
    //     $result = curl_exec($ch);
    //     $err = curl_error($ch);
    //     curl_close($ch);
    //     $val = json_decode($result);

    //     return json_encode($val);
    // }
}
