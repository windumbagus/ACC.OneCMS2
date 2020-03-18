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

        $datacount = json_encode(array(
            "doTransactionApply" => array(   
                // "Id"=> $request->Id_add,
                "P_GUID"=>"",
                "TRANSACTION_CODE"=>"GET_APPLY",
                "P_STATUS"=>"PENDING",
            ),
        ));

        $urlcount = config('global.base_url_sofia').'/restV2/acccash/getdata/transactionapply';

        $chcount = curl_init($urlcount);                   
        curl_setopt($chcount, CURLOPT_POST, true);                                  
        curl_setopt($chcount, CURLOPT_POSTFIELDS, $datacount);
        curl_setopt($chcount, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($chcount, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($chcount, CURLOPT_RETURNTRANSFER, true);                                                                  
        $resultcount = curl_exec($chcount);
        $errcount = curl_error($chcount);
        curl_close($chcount);
        $Hasilscount= json_decode($resultcount); 

         //API GET MstOTR
         $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/MasterOtrAPI/GetTmpOTRUpload"; 
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
            'role'=> $Hasilsrole->OUT_DATA, 
            'countpendingacccash'=>count($Hasilscount->OUT_DATA[0]->dataApply),
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

        $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/MasterOtrAPI/UploadMasterOtr"; 
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
         $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/MasterOtrAPI/UploadCancelMstTmpOtr"; 
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
         $url = config("global.base_url_outsystems")."/ACCWorldCMS/rest/MasterOtrAPI/UploadProceedMstOtr"; 
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
