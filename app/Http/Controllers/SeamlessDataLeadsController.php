<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SeamlessDataLeadsExport;

class SeamlessDataLeadsController extends Controller
{
  

    public function index(Request $request)
    {
   
        $session=[];
        array_push($session,[
            'LoginSession'=>$request->session()->get('LoginSession'),
            'Email'=>$request->session()->get('Email'),
            'Name'=>$request->session()->get('Name'),
            'Id'=>$request->session()->get('Id'),
           // 'RoleId'=>$request->session()->get('RoleId'),
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

        $bulantahun = date('m/Y', strtotime(now()));
        
        //dd($bulantahun);
        $data = json_encode(array(
            "doSendDataCMS" => array(   
                "TRANSACTION_CODE"=>"GET_DATA_LEADS",
                "P_INPUT"=>"$bulantahun",
            ),
        ));
        //dd($data);

         //API GET
        //$url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/UserCMSAPI/GetAllUserCMS?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
        //  $url = $this->base_url_sofia.'/restV2/acccash/getdata/transactionapply';
        // $url = config('global.base_url_sofia').'/restV2/seamless/accone/datacms';
        $url = config('global.base_url_sofia').'/restV2/seamless/accone/datacms';
        // $url = $this->base_url+"restV2/acccash/getdata/transactionapply"; 
        
        //$url = "http://172.16.4.32:8301/restV2/acccash/getdata/transactionaggr";
        //$url = "http://172.16.4.32:8301/restV2/acccash/getdata/transactionapply";
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
        $Hasils= json_decode($result); 
        //dd($Hasils);

        
        if ($Hasilsrole->OUT_DATA == 'Super Admin' || $Hasilsrole->OUT_DATA == 'Super_Admin' || $Hasilsrole->OUT_DATA == 'seamless')
        {
             // dd($Hasils);
             return view(
                'seamless_dataleads',[
                   // 'Role' => $Hasils->Role,
                    'SeamlessDataLeads'=>$Hasils->OUT_DATA,
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


    public function getByBulanTahun(Request $request)
    {
        $bulantahun = $request->Bulantahun;
        
        $data = json_encode(array(
            "doSendDataCMS" => array(   
                "TRANSACTION_CODE"=>"GET_DATA_LEADS",
                "P_INPUT"=>"$bulantahun",
            ),
        ));
        //dd($data);

         //API GET
        //$url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/UserCMSAPI/GetAllUserCMS?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
        //  $url = $this->base_url_sofia.'/restV2/acccash/getdata/transactionapply';
        // $url = config('global.base_url_sofia').'/restV2/seamless/accone/datacms';
        $url = config('global.base_url_sofia').'/restV2/seamless/accone/datacms';
        // $url = $this->base_url+"restV2/acccash/getdata/transactionapply"; 
        
        //$url = "http://172.16.4.32:8301/restV2/acccash/getdata/transactionaggr";
        //$url = "http://172.16.4.32:8301/restV2/acccash/getdata/transactionapply";
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
        $Hasils= json_decode($result); 
        //dd($Hasils);

        return json_encode($Hasils->OUT_DATA); 
    }


    public function download(Request $request)
    {
         //API GET

         $bulantahun = $request->Bulantahun;
        
        $data = json_encode(array(
            "doSendDataCMS" => array(   
                "TRANSACTION_CODE"=>"GET_DATA_LEADS",
                "P_INPUT"=>"$bulantahun",
            ),
        ));
        //dd($data);

         //API GET
        //$url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/UserCMSAPI/GetAllUserCMS?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
        //  $url = $this->base_url_sofia.'/restV2/acccash/getdata/transactionapply';
        // $url = config('global.base_url_sofia').'/restV2/seamless/accone/datacms';
        $url = config('global.base_url_sofia').'/restV2/seamless/accone/datacms';
        // $url = $this->base_url+"restV2/acccash/getdata/transactionapply"; 
        
        //$url = "http://172.16.4.32:8301/restV2/acccash/getdata/transactionaggr";
        //$url = "http://172.16.4.32:8301/restV2/acccash/getdata/transactionapply";
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
        $Hasils= json_decode($result); 
        //dd($Hasils);

         $data=[];
         foreach ($Hasils->OUT_DATA as $Hasil) {
 
             array_push($data,[
                 "LeadsID"=>$Hasil->LEADS_ID,
                 "DateAdded"=>$Hasil->DT_ADDED,
                 "Name"=>$Hasil->NAME,
                 "PhoneNumber"=>$Hasil->PHONE_NUMBER,
                 "DescBrand"=>$Hasil->DESC_BRAND,
                 "DescType"=>$Hasil->DESC_TYPE,
                 "DescModel"=>$Hasil->DESC_MODEL,
                 "DescSP"=>$Hasil->DESC_SP,
                 "Tahun"=>$Hasil->TAHUN,
                 "AmtTDP"=>$Hasil->AMT_TDP,
                 "AmtInstallment"=>$Hasil->AMT_INSTALLMENT,
                 "AmtOTR"=>$Hasil->AMT_OTR,


            ]);
         }
        //  dd($data);
         return Excel::download(new SeamlessDataLeadsExport($data), 'Seamless Data Leads '.$bulantahun.'.xlsx');
    }


}
