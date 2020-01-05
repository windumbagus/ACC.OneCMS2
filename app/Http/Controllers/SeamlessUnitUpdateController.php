<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AccCashApplyExport;

class SeamlessUnitUpdateController extends Controller
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

        $data = json_encode(array(
            "doSendDataCMS" => array(   
                "TRANSACTION_CODE"=>"GET_UNIT_CMS",
                "P_ID"=>$request->Id,
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
          
            //   dd($Hasils->OUT_DATA[0]);
            return view(
                'seamless_unit_update',[
                   // 'Role' => $Hasils->Role,
                    'SeamlessUnitUpdates'=>$Hasils->OUT_DATA[0],
                   // 'Roles'=>$Hasils2->Roles,
                  //  'UserCategories'=>$Hasils2->UserCategory, 
                    'session' => $session
            ]);

    }


    public function update(Request $request)
    {
      
        $data = json_encode(array(
            "doSendDataCMS" => array(   
                "TRANSACTION_CODE"=>"UPDATE_UNIT_CMS",
                "P_LANGUAGE"=>"IN",
                "P_GUID"=>$request->GUID,
                "P_FLAG_NEW_USED"=>$request->FLAG_NEWUSED,
                "P_CD_BRAND"=>$request->KODE_BRAND,
                "P_CD_TYPE"=>$request->KODE_TYPE,
                "P_CD_MODEL"=>$request->KODE_MODEL,
                "P_TAHUN"=>$request->TAHUN,
                "P_FLAG_ACTIVE"=>$request->FLAG_ACTIVE,
                "P_DESC_BRAND"=>$request->DESC_BRAND,
                "P_DESC_TYPE"=>$request->DESC_TYPE,
                "P_DESC_MODEL"=>$request->DESC_MODEL,
                "P_TYPE_MACHINE"=>$request->TYPE_MACHINE,
                "P_MACHINE_CAPACITY"=>$request->MACHINE_CAPACITY,
                "P_TRANSMISSION"=>$request->TRANSMISSION,
                "P_DESC_PRODUCT"=>$request->DESC_PRODUCT,
                "P_USERNAME"=>"ADMIN",

            ),
        ));

        //   dd($data);
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
        $Hasils= json_decode($result);
        // dd($Hasils);
        //dd($err);
        
        
        //  if ($Hasils->OUT_STAT == "T"){
            
            return redirect('seamless-unit/')->with('success','Data berhasil diubah');
        // }else{
            // return redirect('seamless-product-picture/'.$$request->CD_PRODUCT)->with('error',$Hasils->OUT_MESS);
        // }
    }


}
