<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AccCashApplyExport;

class ACCCashApplyDetailController extends Controller
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
            "doTransactionApply" => array(   
                "TRANSACTION_CODE"=>"GET_ACTIVITY",
                "P_ID_APPLY"=>$request->Id,
                "P_LANGUAGE"=>"",
            ),
        ));

       
         //API GET
       
        $url = config('global.base_url_sofia').'/restV2/acccash/getdata/transactionapply';
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

        
            return view(
                'acccash_apply_detail',[
                   // 'Role' => $Hasils->Role,
                    'AccCashApplyDetails'=>$Hasils_detail->OUT_DATA,
                   // 'Roles'=>$Hasils2->Roles,
                  //  'UserCategories'=>$Hasils2->UserCategory, 
                    'session' => $session
            ]);

    }
   
   




}
