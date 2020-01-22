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

        
        //dd($request->Id);
        $data_detail = json_encode(array(
            "doSendDataCMS" => array(   
                "TRANSACTION_CODE"=>"GET_UNIT_CMS_DETAIL",
                "P_ID"=>$request->Id,
                "P_LANGUAGE"=>"IN",
            ),
        ));

        $data_color = json_encode(array(
            "doSendDataCMS" => array(   
                "TRANSACTION_CODE"=>"GET_COLOR_PICT_CMS",
                "P_ID_UNIT"=>$request->Id,
                "P_LANGUAGE"=>"IN",
            ),
        ));

        $data_otr = json_encode(array(
            "doSendDataCMS" => array(   
                "TRANSACTION_CODE"=>"GET_UNIT_OTR_CMS",
                "P_INPUT"=>$request->Id,
                "P_LANGUAGE"=>"IN",
            ),
        ));

        $data_sim = json_encode(array(
            "doSendDataCMS" => array(   
                "TRANSACTION_CODE"=>"GET_SIMULATION_CMS",
                "P_GUID"=>$request->Id,
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
        // dd($Hasils_detail->OUT_DATA);
        // dd($data_detail);



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
        // dd($Hasils_color);


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
        //  dd($Hasils_sim);
        //  dd($data_otr);
        // if($Hasils_otr->OUT_DATA == null)
        // {
        //     $Areaforsim = "";
        // }
        // else
        // {
        //     $Areaforsim = $Hasils_otr->OUT_DATA;
        // }

        // dd($Hasils_sim->OUT_STAT);

        if ($Hasilsrole->OUT_DATA == 'Super Admin' || $Hasilsrole->OUT_DATA == 'Super_Admin' || $Hasilsrole->OUT_DATA == 'seamless')
        {
            return view(
                'seamless_unit_detail',[
                // 'Role' => $Hasils->Role,
                'SeamlessUnitDetails'=>$Hasils_detail->OUT_DATA,
                'SeamlessUnitColors'=>$Hasils_color->OUT_DATA,
                'SeamlessUnitOtrs'=>$Hasils_otr,
                'SeamlessUnitSims'=>$Hasils_sim,
                'unitid'=>$request->Id,

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
                
                "TRANSACTION_CODE"=>"GEN_SIMULATION_CMS",
                "P_ID_UNIT"=>$request->Id,
                "P_CD_AREA"=>$request->Area,
                // "P_CD_AREA"=>"001",
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
         return redirect("seamless-unit-detail/".$request->Id)->with('success','Berhasil Menghitung Simulasi');
    }

    public function uploadpictureshow(Request $request) {

        // $session=[];
        // array_push($session,[
        //     'LoginSession'=>$request->session()->get('LoginSession'),
        //     'Email'=>$request->session()->get('Email'),
        //     'Name'=>$request->session()->get('Name'),
        //     'Id'=>$request->session()->get('Id'),
        //    // 'RoleId'=>$request->session()->get('RoleId'),
        //    // 'SubMenuId'=>"15" // "15" untuk SubMenu UserCms
        // ]);

        $data_color = json_encode(array(
            "doSendDataCMS" => array(   
                "TRANSACTION_CODE"=>"GET_COLOR_PICT_CMS",
                "P_ID_UNIT"=>$request->ID_UNIT,
                "P_GUID"=>$request->GUID,
                "P_LANGUAGE"=>"IN",
            ),
        ));

         //API GET
         $url = config('global.base_url_sofia').'/restV2/seamless/accone/datacms';
        //  dd($data);
     
         // dd($url);
       
        $ch = curl_init($url);                   
        curl_setopt($ch, CURLOPT_POST, true);                                  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_color);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
         $result = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         $Hasils= json_decode($result);
         // dd($Hasils);
         //dd($err);
            return view(
                'seamless_unit_picture',[
                   // 'Role' => $Hasils->Role,
                    'SeamlessUnitPictures'=>$Hasils->OUT_DATA[0],
                   // 'Roles'=>$Hasils2->Roles,
                  //  'UserCategories'=>$Hasils2->UserCategory, 
                    // 'session' => $session
            ]);


    }

    public function uploadpicture(Request $request) {

            $file = $request->input_update_picture_seamlessunit;
            $getContent = file_get_contents($file);
            $content= base64_encode($getContent);
            $name = $file->getClientOriginalName();
            $type = $file->extension();

        $data = json_encode(array(
            "doSendDataCMS" => array(   
                "TRANSACTION_CODE"=>"UPLOAD_COLOR_PICT_CMS",
                "P_ID_UNIT"=>$request->ID_UNIT,
                "P_GUID"=>$request->GUID,
                "P_CD_COLOR"=>$request->CD_COLOR,
			    "P_DESC_COLOR"=>$request->DESC_COLOR,
			    "P_FLAG_PRIMARY"=>$request->FLAG_PRIMARY,
                "P_FILE_NAME"=>$name,
                "P_USER_NAME"=>"ADMIN",
                "P_PATH_FILE"=>'/mnt/ACCONE/unit/'.$name,
                "P_LANGUAGE"=>"IN",
                "P_RAW_FILE"=>$content,
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

    public function deleteselected(Request $request)
    {
        // dd($request->data);
        $data = json_encode(array(
            "doSendDataCMS" => array(   
                "TRANSACTION_CODE"=>"DELETE_OTR",
                "FLAG_SELECT"=>"SELECTED",
                "DATA_UNIT"=>$request->data,
            ),
        ));
        // dd($data);
       
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
        
        return json_encode($Hasils);
    }

    public function deleteotrall(Request $request)
    {

        $dataall = json_encode(array(
                
                "doSendDataCMS" => array(   
                
                    "TRANSACTION_CODE"=>"DELETE_OTR",
                    "FLAG_SELECT"=>"ALL",
                    "DATA_UNIT"=>[array(
                        "GUID"=>null,
                        "ID_UNIT"=>$request->Id,	
                    )],
                ),
        ));

         //API GET
         $urlall = config('global.base_url_sofia').'/restV2/seamless/accone/datacms';
        //   dd($dataall);
         // dd($url);
       
        $chall = curl_init($urlall);                   
        curl_setopt($chall, CURLOPT_POST, true);                                  
        curl_setopt($chall, CURLOPT_POSTFIELDS, $dataall);
        curl_setopt($chall, CURLOPT_SSL_VERIFYPEER, FALSE);   
        curl_setopt($chall, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));                                                             
        curl_setopt($chall, CURLOPT_RETURNTRANSFER, true);  
         $resultall = curl_exec($chall);
         $errall = curl_error($chall);
         curl_close($chall);
         $valall= json_decode($resultall);
        //   dd($valall);
         //dd($err);
         return redirect("seamless-unit-detail/".$request->Id)->with('success','Semua OTR berhasil terhapus');
    }


}
/* 8 Jan 2020 : Fixing Hitung Simulasi

*/