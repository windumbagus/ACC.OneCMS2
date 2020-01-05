<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AccCashApplyExport;

class SeamlessProductDetailUpdateController extends Controller
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
                "TRANSACTION_CODE"=>"GET_PRODUCT",
                "P_SEARCH"=>$request->Id,
                "P_LANGUAGE"=>"IN"
            ),
        ));

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

        if($Hasils->OUT_DATA[0]->FLAG_ACTIVE == "Y")
        {
            $IsActive = true;
        }
        else{
            $IsActive = false;
        }
        // dd($IsActive);

        return view(
            'seamless_product_detail_update',[
                // 'Role' => $Hasils->Role,
                'SeamlessProducts'=>$Hasils->OUT_DATA[0],
                'IsActive'=>$IsActive,
                // 'Roles'=>$Hasils2->Roles,
                //  'UserCategories'=>$Hasils2->UserCategory, 
                'session' => $session
        ]);

    }
   
    public function update(Request $request) {

        // dd($request->FLAG_ACTIVE);

        $data = json_encode(array(
            "doSendDataCMS" => array(   
                "TRANSACTION_CODE"=>"UPDATE_PRODUCT_CMS",
                "P_CD_PRODUCT"=>$request->CD_PRODUCT,
                "P_DT_START"=>$request->DT_START,
                "P_DT_END"=>$request->DT_END,
                "P_FLAG_ACTIVE"=>$request->FLAG_ACTIVE,
                "P_LANGUAGE"=>"IN",
            ),
        ));

        // dd($data);
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
            
            return redirect('seamless-product/')->with('success','Data berhasil diubah');
        // }else{
            // return redirect('seamless-product-picture/'.$$request->CD_PRODUCT)->with('error',$Hasils->OUT_MESS);
        // }

    }



}
