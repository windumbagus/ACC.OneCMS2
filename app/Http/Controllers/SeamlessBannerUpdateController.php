<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AccCashApplyExport;
use Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class SeamlessBannerUpdateController extends Controller
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
                "TRANSACTION_CODE"=>"GET_BANNER_CMS",
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
          
        if ($Hasilsrole->OUT_DATA == 'Super Admin' || $Hasilsrole->OUT_DATA == 'Super_Admin' || $Hasilsrole->OUT_DATA == 'seamless')
        {
           //   dd($Hasils->OUT_DATA[0]);
           return view(
            'seamless_banner_update',[
               // 'Role' => $Hasils->Role,
                'SeamlessBannerUpdates'=>$Hasils->OUT_DATA[0],
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
        $file = $request->addPicture_seamlessbanner;
        //dd($file);
        If(!file_exists($file))
        {
            $content = null;
        }
        else{
            $getcontent = file_get_contents($file);
            $content = base64_encode($getcontent);
            // for resizing
            // $getcontentresizing = (string) Image::make($file)->resize(1435, 576)->encode('data-url');
        
            // $getcontent = file_get_contents($getcontentresizing);
            // $content = base64_encode($getcontent);
             //dd($content);
            $name = $file->getClientOriginalName();
            $type = $file->extension();

        }
        //  dd($request->END_DATE);
        $start_date = $request->START_DATE.' 00:00:00';
        $end_date = $request->END_DATE.' 00:00:00';
        // dd($end_date);
        $data = json_encode(array(
            "doSendDataCMS" => array(   
                "TRANSACTION_CODE"=>"UPDATE_BANNER_CMS",
                "P_ID"=>$request->ID,
                "P_CD_PRODUCT"=>$request->CD_PRODUCT,
                "P_NAME"=>$request->NAME,
                "P_FLAG_ACTIVE"=>$request->FLAG_ACTIVE,
                "P_LANGUAGE"=>"IN",
                "P_DT_START"=>$start_date,
                "P_DT_END"=>$end_date,
                "P_PROMO_CODE"=>$request->PROMO_CODE,
                "P_DESCRIPTION"=>$request->DESCRIPTION,
                "P_IS_ACTIVE_PROMO"=>$request->IS_ACTIVE_PROMO,
                "P_DT_ADDED"=>$request->DT_ADDED,
                "P_USER_ADDED"=>$request->USER_ADDED,
                "P_SYARAT_DAN_KETENTUAN"=>$request->SYARAT_DAN_KETENTUAN,
                "P_PROMO_TYPE"=>$request->PROMO_TYPE,
                "P_PROMO_AMOUNT"=>$request->PROMO_AMOUNT,
                "P_PRODUCT_OWNER"=>$request->PRODUCT_OWNER,
                "P_ORDER_NAME"=>$request->ORDER_NAME,
                "P_JENIS_PROMO"=>$request->JENIS_PROMO,
                "P_PERIODE_PROMO"=>$request->PERIODE_PROMO,
                "P_URL"=>$request->URL_BANNER,
                "P_IS_ACTIVE_BANNER"=>$request->IS_ACTIVE_BANNER,
                "P_ID_FILE"=>$request->ID_FILE,
                "P_USERNAME"=>"ADMIN",
                "P_FILE_NAME"=>$request->FILE_NAME,
                "P_PATH_FILE"=>$request->PATH_FILE,
                "P_RAW_FILE"=>$content,



            ),
        ));

         // dd($content);
        //API GET
        $url = config('global.base_url_sofia').'/restV2/seamless/accone/datacms';
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
            
            return redirect('seamless-banner/')->with('success','Data berhasil diubah');
        // }else{
            // return redirect('seamless-product-picture/'.$$request->CD_PRODUCT)->with('error',$Hasils->OUT_MESS);
        // }
    }


}
