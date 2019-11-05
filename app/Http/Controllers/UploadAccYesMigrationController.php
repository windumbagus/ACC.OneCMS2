<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadAccYesMigrationController extends Controller
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
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/ACCYesMigrationAPI/GetTmpUserAccYes"; 
        $ch = curl_init($url);                                                     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasils= json_decode($result);
        // dd($Hasils);
        
        return view('modal/upload_acc_yes_migration',[
            'UploadMigrations' =>$Hasils,
            'session' => $session
        ]);    
    }

    public function upload(Request $request)
    {
        $request->validate([
            'upload_acc_yes_migration' => 'required',
        ]);

        $file = $request->upload_acc_yes_migration;
        $x= file_get_contents($file);
        $y= base64_encode($x);

        $name = $file->getClientOriginalName();
        $data = json_encode(array(
            "Filename" => "$name",
            "Content" => $y,
        ));
        // dd($data);  

        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/ACCYesMigrationAPI/UploadTmpUserAccYes"; 
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
            return redirect('/acc-yes-migration/upload-page')->with('success','Data ACC Yes Migration Upload Successfull !!!');
        }else{
            return redirect('/acc-yes-migration/upload-page')->with('warning', $Hasils->ErrorMessage);
        }
    }

    public function Cancel(Request $request)
    {
         //API GET
         $url = "https://acc-dev1.outsystemsenterprise.com//ACCWorldCMS/rest/ACCYesMigrationAPI/UploadCancelTmpUserAccYes"; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         // dd($Hasils);

        return redirect('acc-yes-migration');

    }

    public function proceed(Request $request)
    {
        $url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/ACCYesMigrationAPI/UploadProceedTmpUserAccYes"; 
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);

        return redirect('/acc-yes-migration');

    }
}
