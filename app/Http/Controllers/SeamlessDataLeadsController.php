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
            // dd($bulantahun);
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

    public function download($bulan=null,$tahun=null, Request $request)
    {
        $bulantahun= $bulan."/".$tahun;
        $data = json_encode(array(
            "doSendDataCMS" => array(   
                "TRANSACTION_CODE"=>"GET_DATA_LEADS",
                "P_INPUT"=>"$bulantahun",
            ),
        ));
    // dd($bulantahun);
    // dd($data);

    //API GET
    $url = config('global.base_url_sofia').'/restV2/seamless/accone/datacms';

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

                if (property_exists($Hasil, 'LEADS_ID')){
                    $LEADS_ID = $Hasil->LEADS_ID;
                }else{
                    $LEADS_ID = "";
                }
                if (property_exists($Hasil, 'DT_ADDED')){
                    $DT_ADDED = $Hasil->DT_ADDED;
                }else{
                    $DT_ADDED = "";
                }
                if (property_exists($Hasil, 'NAME')){
                    $NAME = $Hasil->NAME;
                }else{
                    $NAME = "";
                }
                if (property_exists($Hasil, 'PHONE_NUMBER')){
                    $PHONE_NUMBER = $Hasil->PHONE_NUMBER;
                }else{
                    $PHONE_NUMBER = "";
                }
                if (property_exists($Hasil, 'DESC_BRAND')){
                    $DESC_BRAND = $Hasil->DESC_BRAND;
                }else{
                    $DESC_BRAND = "";
                }
                if (property_exists($Hasil, 'DESC_TYPE')){
                    $DESC_TYPE = $Hasil->DESC_TYPE;
                }else{
                    $DESC_TYPE = "";
                }
                if (property_exists($Hasil, 'DESC_MODEL')){
                    $DESC_MODEL = $Hasil->DESC_MODEL;
                }else{
                    $DESC_MODEL = "";
                }
                if (property_exists($Hasil, 'CD_SP')){
                    $CD_SP = $Hasil->CD_SP;
                }else{
                    $CD_SP = "";
                }
                if (property_exists($Hasil, 'DESC_SP')){
                    $DESC_SP = $Hasil->DESC_SP;
                }else{
                    $DESC_SP = "";
                }
                if (property_exists($Hasil, 'TAHUN')){
                    $TAHUN = $Hasil->TAHUN;
                }else{
                    $TAHUN = "";
                }
                if (property_exists($Hasil, 'TENOR')){
                    $TENOR = $Hasil->TENOR;
                }else{
                    $TENOR = "";
                }
                if (property_exists($Hasil, 'AMT_TDP')){
                    $AMT_TDP = $Hasil->AMT_TDP;
                }else{
                    $AMT_TDP = "";
                }
                if (property_exists($Hasil, 'AMT_INSTALLMENT')){
                    $AMT_INSTALLMENT = $Hasil->AMT_INSTALLMENT;
                }else{
                    $AMT_INSTALLMENT = "";
                }
                if (property_exists($Hasil, 'AMT_OTR')){
                    $AMT_OTR = $Hasil->AMT_OTR;
                }else{
                    $AMT_OTR = "";
                }
                
                array_push($data_export,[
                    "LEADS_ID"=>$LEADS_ID,
                    "DT_ADDED"=>$DT_ADDED,
                    "NAME"=>$NAME,
                    "PHONE_NUMBER"=>$PHONE_NUMBER,
                    "DESC_BRAND"=>$DESC_BRAND,
                    "DESC_TYPE"=>$DESC_TYPE,
                    "DESC_MODEL"=>$DESC_MODEL,
                    "CD_SP"=>$CD_SP,
                    "DESC_SP"=>$DESC_SP,
                    "TAHUN"=>$TAHUN,
                    "TENOR"=>$TENOR,
                    "AMT_TDP"=>$AMT_TDP,
                    "AMT_INSTALLMENT"=>$AMT_INSTALLMENT,
                    "AMT_OTR"=>$AMT_OTR,
            ]);
            }
        }
        // dd($data_export);
        return Excel::download(new SeamlessDataLeadsExport($data_export), 'Seamless Data Leads '. $bulan.'-'.$tahun .'.xlsx');
    }

}
