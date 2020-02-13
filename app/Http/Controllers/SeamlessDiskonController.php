<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AccCashApplyExport;

class SeamlessDiskonController extends Controller
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


        $data = json_encode(array(
            "doSendDataDiscount" => array(   
                "TRANSACTION_CODE"=>"GET_DISCOUNT",
                "P_INPUT"=>"",
                "P_LANGUAGE"=>"IN",
            ),
        ));

         //API GET
        //$url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/UserCMSAPI/GetAllUserCMS?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
        //  $url = $this->base_url_sofia.'/restV2/acccash/getdata/transactionapply';
        $url = config('global.base_url_sofia').'/restV2/seamless/accone/datadiscount';
        // $url = $this->base_url+"restV2/acccash/getdata/transactionapply"; 
        
        //$url = "http://172.16.4.32:8301/restV2/acccash/getdata/transactionaggr";
        //$url = "http://172.16.4.32:8301/restV2/acccash/getdata/transactionapply";
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

        if ($Hasilsrole->OUT_DATA == 'Super Admin' || $Hasilsrole->OUT_DATA == 'Super_Admin' || $Hasilsrole->OUT_DATA == 'seamless')
        {
            return view(
                'seamless_diskon',[
                   // 'Role' => $Hasils->Role,
                    'SeamlessDiskons'=>$Hasils->OUT_DATA,
                   // 'Roles'=>$Hasils2->Roles,
                  //  'UserCategories'=>$Hasils2->UserCategory,
                  'role'=> $Hasilsrole->OUT_DATA, 
                    'session' => $session
            ]);
        }
        else
        {
            return redirect('/invalid-permission');
        } 
            

    }


   

    public function delete(Request $request)
    {

       
        $data = json_encode(array(
            "doSendDataDiscount" => array(   
                "TRANSACTION_CODE"=>"DELETE_DISCOUNT",
                "P_LANGUAGE"=>"IN",
                "P_GUID"=>$request->GUID,
            ),
        ));
        //dd($data);
         //API GET
        //$url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/UserCMSAPI/GetAllUserCMS?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
        $url = config('global.base_url_sofia').'/restV2/seamless/accone/datadiscount';
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

      
        //dd($Hasils);
        if ($Hasils->OUT_STAT == "T"){
            return redirect("seamless-diskon")->with('success','Master Discount berhasil terhapus');
        }else{
            return redirect("seamless-diskon")->with('error',$Hasils->OUT_MESS);
        }
       
    }

    public function show(Request $request)
    {

        $data = json_encode(array(
            "doSendDataCMS" => array(   
                
                "TRANSACTION_CODE"=>"GET_PRODUCT_DETAIL",
			    "P_FLAG_NEW_USED"=>"N",
			    "P_CD_PRODUCT"=>$request->Id,
			    "P_LANGUAGE"=>"IN"
               
            ),
        ));
        
         //API GET
         $url = config('global.base_url_sofia').'/restV2/seamless/accone/datacms';
        //  dd($data);
     
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

    public function showview(Request $request)
    {

        $data = json_encode(array(
            "doTransactionApply" => array(   
                // "Id"=> $request->Id_add,
                "P_GUID"=>$request->Id,
                // "P_NO_AGGR"=>$request->P_NO_AGGR,
                "TRANSACTION_CODE"=>"GET_APPLY",
                "P_NO_AGGR"=>"",
            ),
        ));
        
         //API GET
         $url = config('global.base_url_sofia').'/restV2/acccash/getdata/transactionapply';
         //dd($data);
        //  $url = "http://172.16.4.32:8301/restV2/acccash/getdata/transactionapply";
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
                "P_STATUS"=>"PENDING",
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
         return Excel::download(new ACCCashApplyExport($data), 'ACCCash Apply '. date("Y-m-d His") .'.xlsx');
    }


}
