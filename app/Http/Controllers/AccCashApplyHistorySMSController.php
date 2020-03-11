<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AccCashHistorySMSExport;

class AccCashApplyHistorySMSController extends Controller
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

        // $now = date('d/m/Y', strtotime(now()));
        // dd($now);
        $data = json_encode(array(
            "doGetHistorySMS" => array(   
                "P_START_DATE"=>"",
                "P_END_DATE"=>"",
                "P_LANGUAGE"=>"IN",
            ),
        ));
        //dd($data);

         //API GET
        //$url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/UserCMSAPI/GetAllUserCMS?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
        //  $url = $this->base_url_sofia.'/restV2/acccash/getdata/transactionapply';
        // $url = config('global.base_url_sofia').'/restV2/seamless/accone/datacms';
        $url = config('global.base_url_sofia').'/restv2/acccash/cms/getdata/historysms';
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

        
        if ($Hasilsrole->OUT_DATA == 'Super Admin' || $Hasilsrole->OUT_DATA == 'Super_Admin' || $Hasilsrole->OUT_DATA == 'acccash')
        {
             // dd($Hasils);
             return view(
                'acccash_historysms',[
                   // 'Role' => $Hasils->Role,
                    'AcccashHistorySMSes'=>$Hasils->OUT_DATA,
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


    public function getByDate(Request $request)
    {
        $startdate =  date('d/m/Y', strtotime($request->startdate));
        $enddate =  date('d/m/Y', strtotime($request->enddate));
            // dd($startdate);
        $data = json_encode(array(
            "doGetHistorySMS" => array(   
                "P_START_DATE"=>$startdate,
                "P_END_DATE"=>$enddate,
                "P_LANGUAGE"=>"IN",
            ),
        ));
        // dd($data);

         //API GET
        //$url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/UserCMSAPI/GetAllUserCMS?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
        //  $url = $this->base_url_sofia.'/restV2/acccash/getdata/transactionapply';
        // $url = config('global.base_url_sofia').'/restV2/seamless/accone/datacms';
        $url = config('global.base_url_sofia').'/restv2/acccash/cms/getdata/historysms';
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
        // dd($Hasils);

        return json_encode($Hasils->OUT_DATA); 
    }

    public function download(Request $request)
    {
        $startdate =  date('d/m/Y', strtotime($request->StartDate));
        $enddate =  date('d/m/Y', strtotime($request->EndDate));
        $data = json_encode(array(
            "doGetHistorySMS" => array(   
                "P_START_DATE"=>$startdate,
                "P_END_DATE"=>$enddate,
                "P_LANGUAGE"=>"IN",
            ),
        ));
    // dd($bulantahun);
    // dd($data);

    //API GET
    $url = config('global.base_url_sofia').'/restv2/acccash/cms/getdata/historysms';

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
        
        $data_export=[];
        if(property_exists($Hasils,'OUT_DATA')){
            foreach ($Hasils->OUT_DATA as $Hasil) {

                if (property_exists($Hasil, 'SMS_ID')){
                    $SMS_ID = $Hasil->SMS_ID;
                }else{
                    $SMS_ID = "";
                }
                if (property_exists($Hasil, 'SMS_MSG')){
                    $SMS_MSG = $Hasil->SMS_MSG;
                }else{
                    $SMS_MSG = "";
                }
                if (property_exists($Hasil, 'SMS_GROUP_ID')){
                    $SMS_GROUP_ID = $Hasil->SMS_GROUP_ID;
                }else{
                    $SMS_GROUP_ID = "";
                }
                if (property_exists($Hasil, 'SMS_STATUS')){
                    $SMS_STATUS = $Hasil->SMS_STATUS;
                }else{
                    $SMS_STATUS = "";
                }
                if (property_exists($Hasil, 'SMS_SENT')){
                    $SMS_SENT = $Hasil->SMS_SENT;
                }else{
                    $SMS_SENT = "";
                }
                if (property_exists($Hasil, 'SMS_DELIVERED')){
                    $SMS_DELIVERED = $Hasil->SMS_DELIVERED;
                }else{
                    $SMS_DELIVERED = "";
                }
                if (property_exists($Hasil, 'SMS_PHONENOTO')){
                    $SMS_PHONENOTO = $Hasil->SMS_PHONENOTO;
                }else{
                    $SMS_PHONENOTO = "";
                }
                if (property_exists($Hasil, 'ID_USER_ADDED')){
                    $ID_USER_ADDED = $Hasil->ID_USER_ADDED;
                }else{
                    $ID_USER_ADDED = "";
                }
                
                
                array_push($data_export,[
                    "SMS_ID"=>$SMS_ID,
                    "SMS_MSG"=>$SMS_MSG,
                    "SMS_GROUP_ID"=>$SMS_GROUP_ID,
                    "SMS_STATUS"=>$SMS_STATUS,
                    "SMS_SENT"=>$SMS_SENT,
                    "SMS_DELIVERED"=>$SMS_DELIVERED,
                    "SMS_PHONENOTO"=>$SMS_PHONENOTO,
                    "ID_USER_ADDED"=>$ID_USER_ADDED,
            ]);
            }
        }
        // dd($data_export);
        return Excel::download(new AccCashHistorySMSExport($data_export), 'Acccash History SMS.xlsx');
    }

}
