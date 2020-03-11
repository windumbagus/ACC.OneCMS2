<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AccCashApplyExport;

class AccCashApplyController extends Controller
{
  
    public function index(Request $request)
    {
    //    dd($this->base_url.'/restV2/acccash/getdata/transactionapply');
        $session=[];
        array_push($session,[
            'LoginSession'=>$request->session()->get('LoginSession'),
            'Email'=>$request->session()->get('Email'),
            'Name'=>$request->session()->get('Name'),
            'Id'=>$request->session()->get('Id'),
            'RoleId'=>$request->session()->get('RoleId'),
           // 'SubMenuId'=>"15" // "15" untuk SubMenu UserCms
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

        $data = json_encode(array(
            "doTransactionApply" => array(   
                // "Id"=> $request->Id_add,
                "P_GUID"=>"",
                "TRANSACTION_CODE"=>"GET_APPLY",
                "P_STATUS"=>$request->Statusapply,
            ),
        ));

        $url = config('global.base_url_sofia').'/restV2/acccash/getdata/transactionapply';

        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasils= json_decode($result); 
           //dd($data);
        //    dd($Hasils);
        if ($Hasilsrole->OUT_DATA == 'Super Admin' || $Hasilsrole->OUT_DATA == 'Super_Admin' || $Hasilsrole->OUT_DATA == 'acccash')
        {
            return view(
                'acccash_apply',[
                   // 'Role' => $Hasils->Role,
                    'ACCCashApplys'=>$Hasils->OUT_DATA,
                   // 'Roles'=>$Hasils2->Roles,
                  //  'UserCategories'=>$Hasils2->UserCategory, 
                  'Statusapply'=>$request->Statusapply,
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


    public function getbystatus(Request $request)
    {
        
        $data = json_encode(array(
            "doTransactionApply" => array(   
                // "Id"=> $request->Id_add,
                "P_GUID"=>"",
                "TRANSACTION_CODE"=>"GET_APPLY",
                "P_STATUS"=>$request->Statusapply,
            ),
        ));
        //dd($data);
         //API GET
        //$url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/UserCMSAPI/GetAllUserCMS?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
       $url = config('global.base_url_sofia').'/restV2/acccash/getdata/transactionapply';
        // $url = "http://172.16.4.32:8301/restV2/acccash/getdata/transactionapply";
        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $Hasils= json_decode($result); 
        //   dd($Hasils);

        return json_encode($Hasils->OUT_DATA[0]->dataApply);
    }


    public function show(Request $request)
    {

        $data = json_encode(array(
            "doTransactionApply" => array(   
                // "Id"=> $request->Id_add,
                "P_GUID"=>$request->Id,
                // "P_NO_AGGR"=>$request->P_NO_AGGR,
                "TRANSACTION_CODE"=>"GET_APPLY",
               
            ),
        ));
        
         //API GET
         $url = config('global.base_url_sofia').'/restV2/acccash/getdata/transactionapply';
         //dd($data);
         // dd($url);
       
        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $val= json_decode($result);
         // dd($val);
         //dd($err);
        return json_encode($val);
    }

    
    public function download(Request $request)
    {
         //API GET

         $data = json_encode(array(
            "doTransactionApply" => array(   
                // "Id"=> $request->Id_add,
                "P_GUID"=>"",
                "TRANSACTION_CODE"=>"GET_APPLY",
                "P_STATUS"=>$request->Statusapply,
            ),
        ));
         //$url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/UserCMSAPI/DownloadUserCMS"; 
         $url = config('global.base_url_sofia').'/restV2/acccash/getdata/transactionapply';
        //  $url = "http://172.16.4.32:8301/restV2/acccash/getdata/transactionapply";
         $ch = curl_init($url);                                                     
         curl_setopt($ch, CURLOPT_POST, true);                                  
         curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                         
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $Hasils= json_decode($result);
         // dd($Hasils);

         $data=[];
         foreach ($Hasils->OUT_DATA[0]->dataApply as $Hasil) {
 
             array_push($data,[
                 "NoAggr"=>$Hasil->NO_AGGR,
                 "Disbursement"=>$Hasil->DISBURSEMENT,
                 "AmtInstallment"=>$Hasil->AMT_INSTALLMENT,
                 "Tenor"=>$Hasil->TENOR,
                 "TujuanPenggunaan"=>$Hasil->TUJUAN_PENGGUNAAN,
                 "Penyedia"=>$Hasil->PENYEDIA,
                 "IDUser"=>$Hasil->ID_USER,
                 "DTAdded"=>$Hasil->DT_ADDED,
                 "IDUserUpdated"=>$Hasil->ID_USER_UPDATED,
                 "DTUpdated"=>$Hasil->DT_UPDATED,
                 "Status"=>$Hasil->STATUS,
                 "Reason"=>$Hasil->REASON,
                 "Btmy"=>$Hasil->BTMY,
                 "PhoneMobile1"=>$Hasil->PHONE_MOBILE1,
                 "PhoneMobile2"=>$Hasil->PHONE_MOBILE2,
                 "Area"=>$Hasil->AREA,
                 "Cabang"=>$Hasil->CABANG,
                 "NoPolisi"=>$Hasil->NO_CAR_POLICE,
                 "PefindoScore"=>$Hasil->PEFINDO_SCORE,
                 "PefindoDetail"=>$Hasil->PEFINDO_DETAIL,

            ]);
         }
        //  dd($data);
         return Excel::download(new ACCCashApplyExport($data), 'ACCCash Apply '.$request->Statusapply.' '. date("Y-m-d His") .'.xlsx');
    }


}
