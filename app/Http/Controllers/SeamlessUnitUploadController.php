<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SeamlessUnitExport;

class SeamlessUnitUploadController extends Controller
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

        // dd($Hasils);
        
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

        if ($Hasilsrole->OUT_DATA == 'Super Admin' || $Hasilsrole->OUT_DATA == 'Super_Admin' || $Hasilsrole->OUT_DATA == 'seamless')
        {
            return view('modal/upload_seamless_unit',[
                'role'=> $Hasilsrole->OUT_DATA,
                'countpendingacccash'=>count($Hasilscount->OUT_DATA[0]->dataApply),
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
            'upload_seamless_unit' => 'required',
        ]);
       
        // $file = $request->upload_seamless_unit;
        // $x= file_get_contents($file);
        // $y= base64_encode($x);
        $x=$request->jsonObject; 
        // $name = $file->getClientOriginalName();
       
        $data = json_encode(array(
            "doSendDataCMS" => array(   
                "TRANSACTION_CODE"=>"INSERT_DATA_UNIT",
                "DataUnit"=>json_decode($x),
            ),
        ));
        //  dd($data);

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
        //   dd($result);

        if($Hasils->OUT_STAT="T"){
            return redirect('/seamless-unit')->with('success','Seamless Unit Upload Successfull !!!');
        }else{
            return redirect('/seamless-unit/upload-page')->with('warning', 'Error');
        }
    }

    public function download(Request $request)
    {
         //API GET

        $data=[];
             array_push($data,[
                 "CD_BRAND"=>"001",
                 "DESC_BRAND"=>"BRAND",
                 "CD_TYPE"=>"T01",
                 "DESC_TYPE"=>"TYPE",
                 "CD_MODEL"=>"099",
                 "DESC_MODEL"=>"MODEL",
                 "TAHUN"=>"2020",
                 "TYPE_MACHINE"=>"BENSIN",
                 "MACHINE_CAPACITY"=>"2500",
                 "TRANSMISSION"=>"M/T",
                 "FLAG_NEWUSED"=>"N",
                 "ID_USER_ADDED"=>"ADMIN",
                 "ID_USER_UPDATED"=>"ADMIN",
                 "FLAG_ACTIVE"=>"Y",
                 "DESC_PRODUCT"=>"",

            ]);
         
        //  dd($data);
         return Excel::download(new SeamlessUnitExport($data), 'SeamlessUnitTemplate.xlsx');
    }

    public function cancel(Request $request)
    {
         
        return redirect('/seamless-unit');

    }

   
}
