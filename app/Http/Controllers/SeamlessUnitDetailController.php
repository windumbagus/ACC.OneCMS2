<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AccCashApplyExport;

class SeamlessUnitDetailController extends Controller
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

        $data_detail = json_encode(array(
            "doSendDataCMS" => array(   
                "TRANSACTION_CODE"=>"GET_UNIT_CMS_DETAIL",
                "P_GUID"=>$request->Id,
                "P_LANGUAGE"=>"IN",
            ),
        ));

        $data_color = json_encode(array(
            "doSendDataCMS" => array(   
                "TRANSACTION_CODE"=>"GET_COLOR_CMS",
                "P_GUID"=>$request->Id,
                "P_LANGUAGE"=>"IN",
            ),
        ));

        $data_otr = json_encode(array(
            "doSendDataCMS" => array(   
                "TRANSACTION_CODE"=>"GET_UNIT_OTR_CMS",
                "P_CD_BRAND"=>$request->Brand,
                "P_CD_TYPE"=>$request->Type,
                "P_CD_MODEL"=>$request->Model,
                "P_TAHUN"=>$request->Tahun,
                "P_LANGUAGE"=>"IN",
            ),
        ));

         //API GET
        //$url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/UserCMSAPI/GetAllUserCMS?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
        //  $url = $this->base_url_sofia.'/restV2/acccash/getdata/transactionapply';
        $url = config('global.base_url_sofia').'/restV2/seamless/accone/datacms';
        // $url = $this->base_url+"restV2/acccash/getdata/transactionapply"; 
        
        //$url = "http://172.16.4.32:8301/restV2/acccash/getdata/transactionaggr";
        //$url = "http://172.16.4.32:8301/restV2/acccash/getdata/transactionapply";
        $ch_detail = curl_init($url);                   
        curl_setopt($ch_detail, CURLOPT_POST, true);                                  
        curl_setopt($ch_detail, CURLOPT_POSTFIELDS, $data_detail);
        curl_setopt($ch_detail, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch_detail, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch_detail, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result_detail = curl_exec($ch_detail);
        $err_detail = curl_error($ch_detail);
        curl_close($ch_detail);
        $Hasils_detail= json_decode($result_detail); 
            //   dd($Hasils_detail);
            //   dd($data_detail);

        $ch_color = curl_init($url);                   
        curl_setopt($ch_color, CURLOPT_POST, true);                                  
        curl_setopt($ch_color, CURLOPT_POSTFIELDS, $data_color);
        curl_setopt($ch_color, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch_color, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch_color, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result_color = curl_exec($ch_color);
        $err_color = curl_error($ch_color);
        curl_close($ch_color);
        $Hasils_color= json_decode($result_color); 
            //  dd($Hasils_color);


        $ch_otr = curl_init($url);                   
        curl_setopt($ch_otr, CURLOPT_POST, true);                                  
        curl_setopt($ch_otr, CURLOPT_POSTFIELDS, $data_otr);
        curl_setopt($ch_otr, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch_otr, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch_otr, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result_otr = curl_exec($ch_otr);
        $err_otr = curl_error($ch_otr);
        curl_close($ch_otr);
        $Hasils_otr= json_decode($result_otr); 
            //  dd($Hasils_otr);
            //  dd($data_otr);

            return view(
                'seamless_unit_detail',[
                   // 'Role' => $Hasils->Role,
                    'SeamlessUnitDetails'=>$Hasils_detail->OUT_DATA,
                    'SeamlessUnitColors'=>$Hasils_color->OUT_DATA,
                    'SeamlessUnitOtrs'=>$Hasils_otr->OUT_DATA,
                    'unitid'=>$request->Id,
                    'brand'=>$request->Brand,
                    'type'=>$request->Type,
                    'model'=>$request->Model,
                    'tahun'=>$request->Tahun,

                   // 'Roles'=>$Hasils2->Roles,
                  //  'UserCategories'=>$Hasils2->UserCategory, 
                    'session' => $session
            ]);

    }
   
    public function show(Request $request)
    {

        $data = json_encode(array(
            "doSendDataCMS" => array(   
                
                "TRANSACTION_CODE"=>"GET_UNIT_CMS_DETAIL",
			    "P_GUID"=>$request->Id,
			    "P_LANGUAGE"=>"IN",
               
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




}
