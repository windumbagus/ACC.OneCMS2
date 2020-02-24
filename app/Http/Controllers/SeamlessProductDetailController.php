<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AccCashApplyExport;

class SeamlessProductDetailController extends Controller
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
            "doSendDataCMS" => array(   
                "TRANSACTION_CODE"=>"GET_PRODUCT",
                "P_SEARCH"=>$request->Id,
                "P_LANGUAGE"=>"IN"
            ),
        ));

        $data_detail = json_encode(array(
            "doSendDataCMS" => array(   
                "TRANSACTION_CODE"=>"GET_PRODUCT_DETAIL",
                "P_FLAG_NEW_USED"=>"N",
                "P_CD_PRODUCT"=>$request->Id,
                "P_LANGUAGE"=>"IN"
            ),
        ));

        $data_pict = json_encode(array(
            "doSendDataCMS" => array(   
                "TRANSACTION_CODE"=>"GET_PRODUCT_PICT",
			    "P_CD_PRODUCT"=>$request->Id,
			    "P_LANGUAGE"=>"IN"
            ),
        ));

        $data_sim = json_encode(array(
            "doSendDataCMS" => array(   
                "TRANSACTION_CODE"=>"SIMULASI_PAKET",
                "P_CD_PRODUCT"=>$request->Id,
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

        $ch_pict = curl_init($url);                   
        curl_setopt($ch_pict, CURLOPT_POST, true);                                  
        curl_setopt($ch_pict, CURLOPT_POSTFIELDS, $data_pict);
        curl_setopt($ch_pict, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch_pict, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch_pict, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result_pict = curl_exec($ch_pict);
        $err_pict = curl_error($ch_pict);
        curl_close($ch_pict);
        $Hasils_pict= json_decode($result_pict); 
            //  dd($Hasils_pict);

        $ch_sim = curl_init($url);                   
        curl_setopt($ch_sim, CURLOPT_POST, true);                                  
        curl_setopt($ch_sim, CURLOPT_POSTFIELDS, $data_sim);
        curl_setopt($ch_sim, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch_sim, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch_sim, CURLOPT_RETURNTRANSFER, true);                                                                  
        $result_sim = curl_exec($ch_sim);
        $err_sim = curl_error($ch_sim);
        curl_close($ch_sim);
        $Hasils_sim= json_decode($result_sim); 


        if ($Hasilsrole->OUT_DATA == 'Super Admin' || $Hasilsrole->OUT_DATA == 'Super_Admin' || $Hasilsrole->OUT_DATA == 'seamless')
        {
            return view(
                'seamless_product_detail',[
                   // 'Role' => $Hasils->Role,
                    'SeamlessProducts'=>$Hasils->OUT_DATA,
                    'SeamlessProductDetails'=>$Hasils_detail->OUT_DATA,
                    'SeamlessProductPicts'=>$Hasils_pict->OUT_DATA,
                    'SeamlessProductSims'=>$Hasils_sim->OUT_DATA,
                    'CdProduct'=>$request->Id,

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

    public function hitungsimulasi(Request $request)
    {

        $datasimulasi = json_encode(array(
            "doSendDataCMS" => array(   
                
                "TRANSACTION_CODE"=>"GEN_SIMULASI_PAKET",
                "P_CD_PRODUCT"=>$request->Id,
                "P_ID_UNIT"=>$request->Unitid,
                "P_LANGUAGE"=>"IN",
            ),
        ));
        //dd($datasimulasi);
         //API GET
         $urlsimulasi = config('global.base_url_sofia').'/restV2/seamless/accone/datacms';
        //  dd($datasimulasi);
         // dd($url);
       
        $chsimulasi = curl_init($urlsimulasi);                   
        curl_setopt($chsimulasi, CURLOPT_POST, true);                                  
        curl_setopt($chsimulasi, CURLOPT_POSTFIELDS, $datasimulasi);
        curl_setopt($chsimulasi, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($chsimulasi, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($chsimulasi, CURLOPT_RETURNTRANSFER, true);  
         $resultsimulasi = curl_exec($chsimulasi);
         $errsimulasi = curl_error($chsimulasi);
         curl_close($chsimulasi);
         $valsimulasi= json_decode($resultsimulasi);
        //   dd($valsimulasi);
         //dd($err);
         return redirect("seamless-product-detail/".$request->Id)->with('success','Berhasil Menghitung Simulasi');
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
