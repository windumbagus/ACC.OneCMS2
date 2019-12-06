<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadMasterGcmUpload extends Controller
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
        $url = config('global.base_url_outsystems')."/ACCWorldCMS/rest/MasterGcmAPI/GetAllTmpGcm"; 
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasils= json_decode($result);
        // dd($Hasils);
        
        return view('modal/upload_master_gcm',[
            'TmpGCMs' =>$Hasils,
            'session' => $session
            ]);    
    }

    public function upload(Request $request)
    {
        $request->validate([
            'upload_master_gcm' => 'required',
        ]);

        $file = $request->upload_master_gcm;
        $x= file_get_contents($file);
        $y= base64_encode($x);

        $name = $file->getClientOriginalName();
        $data = json_encode(array(
            "Filename" => "$name",
            "Content" => $y,
        ));
        // dd($data);  

        $url = config('global.base_url_outsystems')."/ACCWorldCMS/rest/MasterGcmAPI/UploadMasterGcm"; 
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
            return redirect('/master-gcm/upload-page')->with('success','Data master GCM Upload Successfull !!!');
        }else{
            return redirect('/master-gcm/upload-page')->with('warning', $Hasils->ErrorMessage);
        }
    }

    public function cancel(Request $request)
    {
         //API GET
         $url = config('global.base_url_outsystems')."/ACCWorldCMS/rest/MasterGcmAPI/UploadCancelMstTmpGcm"; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         // dd($Hasils);

        return redirect('/master-gcm');

    }

    public function proceed(Request $request)
    {
        $url = config('global.base_url_outsystems')."/ACCWorldCMS/rest/MasterGcmAPI/UploadProceedMstGcm"; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);

        return redirect('/master-gcm');

    }
}
