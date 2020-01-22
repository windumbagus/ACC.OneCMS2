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

        $role = json_encode(array(  
            // "Id"=> $request->Id_add,
            "ROLEID"=>$request->session()->get('RoleId'),
        
        ));

        $urlrole = config('global.base_url_outsystems').'/ACCWorldCMS/rest/CheckRoleAPI/CheckRole';

        $chrole = curl_init($urlrole);                   
        curl_setopt($chrole, CURLOPT_POST, true);                                  
        curl_setopt($chrole, CURLOPT_POSTFIELDS, $role);
        curl_setopt($chrole, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($chrole, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($chrole, CURLOPT_RETURNTRANSFER, true);                                                                  
        $resultrole = curl_exec($chrole);
        $errrole = curl_error($chrole);
        curl_close($chrole);
        $Hasilsrole= json_decode($resultrole);
        //dd($Hasilsrole);

        //API GET
        $url = config('global.base_url_outsystems')."/ACCWorldCMS/rest/ACCYesMigrationAPI/GetTmpUserAccYes"; 
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
            'role'=> $Hasilsrole->OUT_DATA, 
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

        $url = config('global.base_url_outsystems')."/ACCWorldCMS/rest/ACCYesMigrationAPI/UploadTmpUserAccYes"; 
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
         $url = config('global.base_url_outsystems')."/ACCWorldCMS/rest/ACCYesMigrationAPI/UploadCancelTmpUserAccYes"; 
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
        $url = config('global.base_url_outsystems')."/ACCWorldCMS/rest/ACCYesMigrationAPI/UploadProceedTmpUserAccYes"; 
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
