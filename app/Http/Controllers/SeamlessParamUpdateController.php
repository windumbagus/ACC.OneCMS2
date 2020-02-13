<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AccCashApplyExport;

class SeamlessParamUpdateController extends Controller
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

        $data = json_encode(array(
            "doSendDataCustomerApply" => array(   
                "TRANSACTION_CODE"=>"GET_PARAM_SIMULATION",
                "P_CD_PRODUCT"=>$request->CD_PRODUCT,
                "P_LANGUAGE"=>"IN",
            ),
        ));

         //API GET
        //$url = "https://acc-dev1.outsystemsenterprise.com/ACCWorldCMS/rest/UserCMSAPI/GetAllUserCMS?RoleId=".$session[0]["RoleId"]."&SubMenuId=".$session[0]["SubMenuId"]; 
        //  $url = $this->base_url_sofia.'/restV2/acccash/getdata/transactionapply';
        $url = config('global.base_url_sofia').'/restV2/seamless/accone/customerapply';
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
          
        if ($Hasilsrole->OUT_DATA == 'Super Admin' || $Hasilsrole->OUT_DATA == 'Super_Admin' || $Hasilsrole->OUT_DATA == 'seamless')
        {
           //   dd($Hasils->OUT_DATA[0]);
           return view(
            'seamless_param_update',[
               // 'Role' => $Hasils->Role,
                'SeamlessParamUpdates'=>$Hasils->OUT_DATA[0],
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


    public function update(Request $request)
    {
        // dd($end_date);
        $data = json_encode(array(
            "doSendParamSimulation" => array(   
                "TRANSACTION_CODE"=>"UPDATE_PARAM_SIMULATION",
                "P_CD_PRODUCT"=>$request->CD_PRODUCT,
                "P_PERC_DP"=>$request->PERC_DP,
                "P_TENOR"=>$request->TENOR,
                "P_TYPE_INSU"=>$request->TYPE_INSU,
                "P_MODE_INSU"=>$request->MODE_INSU,
                "P_FLAG_ACP"=>$request->FLAG_ACP,
                "P_FLAG_ADDM"=>$request->FLAG_ADDM,
                "P_USER"=>"ADMIN",
                "P_LANGUAGE"=>"IN",
            ),
        ));

         // dd($content);
        //API GET
        $url = config('global.base_url_sofia').'/restV2/seamless/accone/paramsimulation';
        //   dd($data);

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
        //dd($err);
        
        
        //  if ($Hasils->OUT_STAT == "T"){
            
            return redirect('seamless-param/')->with('success','Data berhasil diubah');
        // }else{
            // return redirect('seamless-param-picture/'.$$request->CD_PRODUCT)->with('error',$Hasils->OUT_MESS);
        // }
    }


}
