<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SeamlessOtrExport;

class SeamlessOtrUploadController extends Controller
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

        if ($Hasilsrole->OUT_DATA == 'Super Admin' || $Hasilsrole->OUT_DATA == 'Super_Admin' || $Hasilsrole->OUT_DATA == 'seamless')
        {
           //   dd($Hasils->OUT_DATA[0]);
           return view('modal/upload_seamless_otr',[
            'role'=> $Hasilsrole->OUT_DATA,
            'session' => $session
            ]);    
        }
        else
        {
            return redirect('/invalid-permission');
        }


       
   
    }

    public function upload(Request $request)
    {
        $request->validate([
            'upload_seamless_unit_otr' => 'required',
        ]);
       
        // $file = $request->upload_seamless_unit_otr;
        $x=$request->jsonObject; 
        // $y= base64_encode($x);

        // $name = $file->getClientOriginalName();
        //dd($x);
        $data = json_encode(array(
            "doSendDataCMS" => array(   
                "TRANSACTION_CODE"=>"INSERT_DATA_UNIT_OTR",
                "DataUnitOTR"=>json_decode($x),
            ),
        ));
        // dd($data);

        $url = config('global.base_url_sofia')."/restV2/seamless/accone/datacms"; 
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
        //  dd($Hasils);

        if($Hasils->OUT_STAT="T"){
            return redirect('/seamless-otrupload')->with('success','Seamless Unit OTR Upload Successfull !!!');
        }else{
            return redirect('/seamless-otrupload')->with('warning', $Hasils->OUT_MESS);
        }
    }

    public function download(Request $request)
    {
         //API GET

        $data=[];
             array_push($data,[
                 "ID_UNIT"=>"1234",
                 "CD_AREA"=>"001",
                 "OTR"=>"250000000",
                 "ID_USER_ADDED"=>"ADMIN",
                 "ID_USER_UPDATED"=>"ADMIN",
                 "CD_BRAND"=>"001",
                 "CD_TYPE"=>"T01",
                 "CD_MODEL"=>"033",
                 "TAHUN"=>"2020",

            ]);
         
        //   dd($data);
         return Excel::download(new SeamlessOtrExport($data), 'SeamlessOtrTemplate.xlsx');
    }

    public function cancel(Request $request)
    {
         
        return redirect('/seamless-otrupload');

    }

   
}
